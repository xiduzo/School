/*jslint browser: true, devel: true, eqeq: true, plusplus: true, sloppy: true, vars: true, white: true*/

// The user (O) begins with playing
var uT = true,
	g = true,
	m = 0;

var gW = 0,
	gL = 0;

// Set two arrays to remember the user choices
var xT = [],
	oT = [];

// Set different win ways
var wA = [
	[1, 2, 3], // Top row
	[4, 5, 6], // Middle row
	[7, 8, 9], // Bottom row
	[1, 4, 7], // Left row down
	[2, 5, 8], // Middle row down
	[3, 6, 9], // Right row down
	[1, 5, 9], // Cros from left top to right bottom
	[3, 5, 7] /// Cross from rught top to left bottom
];
// Make some vars needed for the script
var c, t, ti, ft, s, i, p, v, co;

// Extend the Array prototype
// http://stackoverflow.com/questions/237104/array-containsobj-in-javascript
Array.prototype.contains = function (o) {
	i = this.length;
	while (i--) {
		if (this[i] === o) {
			return true;
		}
	}
	return false;
};

// Get all td's as a tiles array
ti = document.querySelectorAll('td');
s = document.querySelectorAll('span');

// Resets the game
function rG(w) {
	// Add the score
	if (w) {
		gW++;
	} else {
		gL++;
	}

	s[0].innerHTML = gW;
	s[1].innerHTML = gL;

	// Loop trough all the tiles to make them clickable
	for (i = 0; i < 9; i++) {
		ti[i].className = "free";
		ti[i].innerHTML = "";
	}

	// Reset the game variables
	m = 0;
	xT = [];
	oT = [];
}

// Check the array agains the win arrays
function cA(a) {
	// Loop trough the winArrays arrays
	for (p in wA) {
		// Set the count to 0
		co = 0;
		// Loop trough the array
		for (v in wA) {
			// Check if the array got the value from the wintArrays arras
			if (a.contains(wA[p][v])) {
				// If so, add one to the count
				co++;
				// If the count is more than 2, someone got 3 in a row and won the game
				if (co > 2) {
					// Set the winner and reset the game
					rG(uT);
				}
			}
		}
	}
	uT = !uT;
}

// Push the choice to the array
function aA(a, c) {
	// Add the item to the array
	a.push(c);
	// Sort the array
	a.sort(function (a, b) {
		return a - b;
	});

	// Check if you got an winning array, you can only win if you did 3 or more moves
	cA(a);
}

// Make a (stupid) AI choice
function aI() {
	// Haven't done anythin with the difficult yet
	// This is just a random move generator basicly
	// Get all the non clicked tiles for the AI
	ft = document.querySelectorAll('td.free');
	// Click a random tile out of the nonClickedTiles array
	ti[ft[Math.floor(Math.random() * ft.length)].id - 1].click();
}

// Change the value of the tile clicked
function cT(t, v, c) {
	t.innerHTML = v;
	t.classList.add(c);
}

// If a tile is clicked, excecute this function
function mM(e) {

	// Set the move
	m++;

	// Get the id of the clicked button
	c = e.target.id;

	// Set the target for the clicket item
	t = document.getElementById(c);

	// Check if the tile is occupied
	if (t.classList.contains("occupied")) {
		// Give the player feedback
		alert("Bezet!");
	}
	// If the tile is not occupied
	else {
		// Set the target to occupied
		t.className = "occupied";

		// Set the string to an integer
		c = parseInt(c, 10);

		// Set the turn
		if (uT) {
			cT(t, "X", "X");
			aA(xT, c);
			aI();
		} else {
			cT(t, "O", "O");
			aA(oT, c);
		}

		// Check if tiles are full and there is still no winner
		if (m >= 9 && g) {
			rG(false);
		}
	}
}

// Loop trough all the tiles to make them clickable
for (i = 0; i < 9; i++) {
	ti[i].addEventListener('click', mM);
}

// checking each X seconds if the player made a move
//var aT = setInterval(function () {
//	if (!uT && g) {
//		aI();
//	}
//}, 500); // 1000 = 1 second