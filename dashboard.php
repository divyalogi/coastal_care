 
<?php
session_start();


if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}


$conn = new mysqli("localhost","root","","coastalcare");

if($conn->connect_error){
    die("Database Connection Failed: " . $conn->connect_error);
}


$username = $_SESSION['username'];
$role     = $_SESSION['role'] ?? "User";


$sql = "SELECT * FROM users_profile WHERE username='$username'";
$result = $conn->query($sql);

if($result && $result->num_rows > 0){
    $profile = $result->fetch_assoc();
}else{
    $profile = null;
}


if(isset($_GET['logout'])){
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Coastal Care Dashboard</title>
<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css"/>

<style>
body{
margin:0;
font-family:Segoe UI,sans-serif;
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
min-height:100vh;
}


.header{
background:white;
margin:20px;
padding:18px;
border-radius:12px;
display:flex;
flex-direction:column;
gap:12px;
}

.header-top{
display:flex;
justify-content:space-between;
align-items:center;
}

.logout{
background:#1f4e5f;
color:white;
border:none;
padding:8px 14px;
border-radius:6px;
cursor:pointer;
}

#searchBar{
width:100%;
padding:14px;
border-radius:12px;
border:none;
font-size:16px;
box-shadow:0 5px 15px rgba(0,0,0,.2);
}


.welcome{
background:white;
margin:20px;
padding:18px;
border-radius:12px;
}


.modules{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin:20px;
padding-bottom:90px;
}


.card{
position:relative;
height:120px;
border-radius:14px;
overflow:hidden;
cursor:pointer;
box-shadow:0 6px 18px rgba(0,0,0,.2);
display:flex;
align-items:center;
justify-content:center;
color:white;
font-size:20px;
font-weight:600;
}

.card::before{
content:"";
position:absolute;
inset:0;
background-size:cover;
background-position:center;
filter:blur(6px);
transform:scale(1.2);
}

.card span{
position:relative;
background:rgba(0,0,0,.5);
padding:12px 18px;
border-radius:12px;
}

.home::before{background-image:url("https://images.unsplash.com/photo-1507525428034-b723cf961d3e");}
.weather::before{background-image:url("https://images.unsplash.com/photo-1501630834273-4b5604d2ee31");}
.cyclone::before{background-image:url("https://images.unsplash.com/photo-1527482797697-8795b05a13fe");}
.donor::before{background-image:url("https://images.unsplash.com/photo-1488521787991-ed7bbaae773c");}
.relief::before{background-image:url("https://images.unsplash.com/photo-1605902711622-cfb43c44367f");}
.shelter::before{background-image:url("https://images.unsplash.com/photo-1590490360182-c33d57733427");}
.alert::before{background-image:url("https://images.unsplash.com/photo-1504384308090-c894fdcc538d");}
.help::before{background-image:url("https://images.unsplash.com/photo-1521791136064-7986c2920216");}


#contentBox{
display:none;
background:white;
margin:20px;
padding:22px;
border-radius:14px;
box-shadow:0 6px 18px rgba(0,0,0,.2);
padding-bottom:90px;
}

.home-btn{
background:#1f4e5f;
color:white;
border:none;
padding:8px 14px;
border-radius:6px;
cursor:pointer;
margin-top:10px;
}

#map{
height:350px;
margin-top:15px;
border-radius:12px;
}

#windyMap{
width:100%;
height:400px;
border:none;
border-radius:12px;
}


#profileBox{
    display:none;
    position:fixed;
    overflow:visible;

    top:50%;
    left:50%;

    transform:translate(-50%, -50%);

    width:400px;
    max-width:90%;

    background:white;
    padding:25px;
    border-radius:10px;

    box-shadow:0 0 15px rgba(0,0,0,0.3);

    z-index:999;
    #profileBox input,
    #profileBox select{
    width:100%;
    padding:8px;
    margin-bottom:10px;
    #profileOverlay{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    z-index:998;
}
}
}


.bottom-nav{
position:fixed;
bottom:0;
width:100%;
background:#1f4e5f;
display:flex;
justify-content:space-around;
padding:12px;
color:white;
font-size:20px;
}

.bottom-nav span{cursor:pointer;}

input{
width:100%;
padding:10px;
margin:8px 0;
}
</style>
</head>

<body>


<div id="profileBox">

<h3>User Profile</h3>

<form method="POST" enctype="multipart/form-data">

<?php if(!empty($profile['photo'])){ ?>
<img src="uploads/<?php echo $profile['photo']; ?>"
style="width:80px;height:80px;border-radius:50%;"><br>
<?php } ?>

<b>Username:</b> <?php echo htmlspecialchars($username); ?><br><br>

Name:<br>
<input type="text" name="name"
value="<?php echo $profile['name'] ?? ''; ?>" required>

Age:<br>
<input type="number" name="age"
value="<?php echo $profile['age'] ?? ''; ?>" required>

Gender:<br>
<select name="gender">
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>

Email:<br>
<input type="email" name="email"
value="<?php echo $profile['email'] ?? ''; ?>" required>

Phone:<br>
<input type="text" name="phone"
value="<?php echo $profile['phone'] ?? ''; ?>" required>

Profile Photo:<br>
<input type="file" name="photo">

<br><br>
<button type="submit" name="save_profile">Save Profile</button>

</form>

</div>

<div class="header">
<div class="header-top">
<h2>Coastal Care</h2>
<button class="logout" onclick="location.href='?logout=1'">Logout</button>
</div>
<input id="searchBar" type="text" placeholder="Search modules..." onkeyup="filterModules()">
</div>

<div class="welcome">
<h3>Welcome, <?php echo htmlspecialchars($username); ?> 👋</h3>
<p>Real-time coastal disaster monitoring system</p>
</div>


<div class="modules" id="dashboard">
<div class="card home" onclick="goHomepage()"><span>🏠 Home</span></div>
<div class="card weather" onclick="showWeather()"><span>🌦 Weather</span></div>
<div class="card cyclone" onclick="openCyclone()"><span>🌀 Cyclone Tracker</span></div>
<div class="card donor" onclick="showDonor()"><span>🧑‍🤝‍🧑 Donors</span></div>

<div class="card relief" onclick="showRelief()"><span>📦 Relief</span></div>

<div class="card shelter" onclick="showShelter()"><span>🏕 Shelter</span></div>

<div class="card alert" onclick="showVolunteer()"><span>🙋 Volunteer</span></div>

<div class="card help" onclick="window.location.href='help.php'"><span>💬 Help & Feedback</span></div>
</div>


<div id="contentBox">
<button class="home-btn" onclick="backDashboard()">← Back</button>
<h2 id="title"></h2>
<div id="content"></div>
<div id="map"></div>
<button onclick="checkDistance()">Check Distance</button>

<p id="distanceResult"></p>
</div>

<div class="bottom-nav">
<span onclick="goHomepage()">🏠</span>
<span onclick="showWeather()">🌦</span>
<span onclick="openCyclone()">🌀</span>
<span onclick="toggleProfile()">👤</span>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>

<script>

function toggleProfile(){
var box = document.getElementById("profileBox");
box.style.display = (box.style.display === "block") ? "none" : "block";
}

const dashboard=document.getElementById("dashboard");
const box=document.getElementById("contentBox");
const title=document.getElementById("title");
const content=document.getElementById("content");

let map;


function goHomepage(){ window.location.href="index.php"; }


function backDashboard(){
box.style.display="none";
dashboard.style.display="grid";
if(map){ map.remove(); }
}


function showWeather(){
dashboard.style.display="none";
box.style.display="block";

title.innerText="Weather Report - Chennai";

content.innerHTML=`
<p><b>Temperature:</b> 31°C</p>
<p><b>Condition:</b> "mostly sunny"</p>
<p><b>Wind Speed:</b> 14 km/h</p>
<p><b>Humidity:</b> 70%</p>
`;

loadMap(13.08,80.27,"Weather Area");
}


function openCyclone(){
dashboard.style.display="none";
box.style.display="block";

title.innerText="Live Cyclone & Wind Tracker";

content.innerHTML=`
<iframe id="windyMap"
src="https://embed.windy.com/embed2.html?lat=13&lon=82&zoom=5&overlay=wind&product=ecmwf">
</iframe>
<p><i>Live Wind Visualization</i></p>
`;

if(map){ map.remove(); }
}


function showMapModule(t,msg){
dashboard.style.display="none";
box.style.display="block";
title.innerText=t;
content.innerHTML=`<p>${msg}</p>`;
loadMap(13.08,80.27,"Monitoring Area");
}


function loadMap(lat,lng,label){

if(!document.getElementById("map")) return;

if(map){ map.remove(); }

map=L.map('map').setView([lat,lng],6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
attribution:'© OpenStreetMap contributors'
}).addTo(map);

L.marker([lat,lng]).addTo(map).bindPopup(label).openPopup();
}


function filterModules(){
let input=document.getElementById("searchBar").value.toLowerCase();
let cards=document.querySelectorAll(".card");
cards.forEach(card=>{
card.style.display=card.innerText.toLowerCase().includes(input)?"flex":"none";
});
}


function showDonor(){

dashboard.style.display="none";
box.style.display="block";

title.innerText="Donor Module";

content.innerHTML = `

<form method="POST">

<h3>Donate Relief Materials</h3>

Name:<br>
<input type="text" name="dname" required><br>

Mobile:<br>
<input type="text" name="dphone" required><br>

Items Donating:<br>
<select name="ditems">
<option>Bread</option>
<option>Biscuits</option>
<option>Water Bottles</option>
<option>Clothes</option>
<option>Medicines</option>
<option>Other</option>
</select><br>

Quantity:<br>
<input type="number" name="dqty" required><br>

Vehicle Available:<br>
<select name="dvehicle">
<option>Yes</option>
<option>No</option>
</select><br><br>

<input type="hidden" name="lat" id="donorLat">
<input type="hidden" name="lon" id="donorLon">

<button type="submit" name="save_donor">
Submit Donation
</button>

<button type="button" onclick="getLocationAndMap()">
Detect My Location
</button>

</form>

<p id="arrivalTime"></p>
`;

}




function showRelief(){

dashboard.style.display="none";
box.style.display="block";

title.innerText="Relief Needs";

content.innerHTML=`
Affected Area:<br>
<input type="text"><br>

Urgency Level:<br>
<select>
<option>High</option>
<option>Medium</option>
<option>Low</option>
</select><br>

Items Required:<br>
<input type="text"><br>

People Affected:<br>
<input type="number"><br>

Contact Person:<br>
<input type="text"><br>

Phone:<br>
<input type="text"><br>
`;

loadMap(13.08,80.27,"Affected Area");

}




function showVolunteer(){

dashboard.style.display="none";
box.style.display="block";

title.innerText="Volunteer Registration";

content.innerHTML = `

<form method="POST">

<h3>Volunteer Details</h3>

Name:<br>
<input type="text" name="vname" required><br>

Age:<br>
<input type="number" name="vage" required><br>

Gender:<br>
<select name="vgender">
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select><br>

Phone:<br>
<input type="text" name="vphone" required><br>

Skills:<br>
<input type="text" name="vskills"><br>

Previous Certificates / Badges:<br>
<input type="text" name="vcert" placeholder="NCC, NSS, First Aid etc"><br>

<input type="hidden" name="vlat" id="vlat">
<input type="hidden" name="vlon" id="vlon">

<br>

<button type="submit" name="save_volunteer">
Register Volunteer
</button>

<button type="button" onclick="getVolunteerLocation()">
Enable My Location
</button>

<hr>

<h3>Affected Person Location</h3>

<button type="button" onclick="getAffectedLocation()">
Enable Affected Location
</button>

<p id="distanceInfo"></p>

</form>
`;
}






function showShelter(){

dashboard.style.display="none";
box.style.display="block";

title.innerText="Shelter Camps";

content.innerHTML=`
Shelter Name: Coastal Camp 1<br>
Capacity: 200 People<br>
Available Beds: 120<br>
Facilities: Food, Water, Medical<br>
Contact: 9876543210
`;

loadMap(13.20,80.30,"Shelter Camp");

}




function getLocationAndMap(){

if(navigator.geolocation){

navigator.geolocation.getCurrentPosition(function(position){
document.getElementById("donorLat").value = lat;
document.getElementById("donorLon").value = lon;
let lat = position.coords.latitude;
let lon = position.coords.longitude;

loadMap(lat,lon,"Your Location");


let reliefLat = 13.08;
let reliefLon = 80.27;


let distance = Math.sqrt(
Math.pow(lat-reliefLat,2) +
Math.pow(lon-reliefLon,2)
) * 111;

let time = (distance / 40).toFixed(2);

let arrival = document.getElementById("arrivalTime");
if(arrival){
arrival.innerHTML =
"<b>Estimated Arrival Time:</b> "+time+" hours";
}

});

}else{
alert("Geolocation not supported");
}

}
let volunteerLat, volunteerLon;
let affectedLat, affectedLon;



function getVolunteerLocation(){

if(navigator.geolocation){

navigator.geolocation.watchPosition(function(position){

volunteerLat = position.coords.latitude;
volunteerLon = position.coords.longitude;

});

}else{
alert("Location not supported");
}

}



function getAffectedLocation(){

if(navigator.geolocation){

navigator.geolocation.getCurrentPosition(function(position){

affectedLat = position.coords.latitude;
affectedLon = position.coords.longitude;

loadMap(affectedLat, affectedLon, "Affected Location");

checkDistance();

});

}else{
alert("Location not supported");
}

}



function checkDistance(){

if(volunteerLat && affectedLat){

let distance = calculateDistance(
volunteerLat, volunteerLon,
affectedLat, affectedLon
);

let info = document.getElementById("distanceInfo");
if(info){
info.innerHTML =
"<b>Distance Between Volunteer & Affected Person:</b> "
+ distance.toFixed(2) + " KM";
}

}

}


function calculateDistance(lat1, lon1, lat2, lon2){

const R = 6371;

let dLat = (lat2-lat1) * Math.PI/180;
let dLon = (lon2-lon1) * Math.PI/180;

let a =
Math.sin(dLat/2) * Math.sin(dLat/2) +
Math.cos(lat1*Math.PI/180) *
Math.cos(lat2*Math.PI/180) *
Math.sin(dLon/2) * Math.sin(dLon/2);

let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

return R * c;

}



function showBothMarkers(){

if(map){
map.remove();
}

map = L.map('map').setView(
[(volunteerLat+affectedLat)/2,
(volunteerLon+affectedLon)/2],
10
);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
attribution:'© OpenStreetMap'
}).addTo(map);

L.marker([volunteerLat, volunteerLon])
.addTo(map)
.bindPopup("Volunteer");

L.marker([affectedLat, affectedLon])
.addTo(map)
.bindPopup("Affected Person");

}

</script>
</body>
</html> 