// Jess - storepage
// JavaScript to check amount of gold
// If user has valid amount, they can purchase powerups
// If user does not, buttons become disabled

gold = document.getElementById("checkGold").innerHTML; //div with php code from storepage.php
goldString = gold.split(' ').map(Number);
console.log(goldString[27]);

amount = goldString[27];
treat = document.getElementById("buyTreat");
nap = document.getElementById("buyNap");
play = document.getElementById("buyPlay");


if(amount < 100) {
    treat.disabled = true;
    treat.innerHTML = "Not enough gold";
}

if(amount < 50) {
    nap.disabled = true;
    nap.innerHTML = "Not enough gold";
}

if(amount < 100) {
    play.disabled = true;
    play.innerHTML = "Not enough gold";
}