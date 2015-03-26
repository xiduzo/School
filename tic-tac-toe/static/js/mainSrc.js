/*jslint browser: true, devel: true, eqeq: true, plusplus: true, sloppy: true, vars: true, white: true*/

// Extend the Array prototype
// http://stackoverflow.com/questions/237104/array-containsobj-in-javascript
Array.prototype.contains = function (obj) {
	var i = this.length;
	while (i--) {
		if (this[i] === obj) {
			return true;
		}
	}
	return false;
};

// The user (O) begins with playing
var userTurn = true,
	game = true,
	moves = 0;

var gamesWon = 0,
	gamesLost = 0;

// Set two arrays to remember the user choices
var xTiles = [],
	oTiles = [];

// Set different win ways
var winArrays = [
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
var choice, target, tiles, nonClickedTiles, scores, i, pos, val, count;

// Get all td's as a tiles array
tiles = document.querySelectorAll('td');
scores = document.querySelectorAll('span');

// Resets the game
function resetGame(winner) {
	// Add the score
	if (winner) {
		gamesWon++;
	} else {
		gamesLost++;
	}

	scores[0].innerHTML = gamesWon;
	scores[1].innerHTML = gamesLost;

	// Loop trough all the tiles to make them clickable
	for (i = 0; i < 9; i++) {
		tiles[i].className = "free";
		tiles[i].innerHTML = "";
	}

	// Reset the game variables
	moves = 0;
	xTiles = [];
	oTiles = [];
}

// Check the array agains the win arrays
function checkArrayForWin(array) {
	// Loop trough the winArrays arrays
	for (pos = 0; pos < winArrays.length; pos++) {
		// Set the count to 0
		count = 0;
		// Loop trough the array
		for (val = 0; val < winArrays[pos].length; val++) {
			// Check if the array got the value from the wintArrays arras
			if (array.contains(winArrays[pos][val])) {
				// If so, add one to the count
				count++;
				// If the count is more than 2, someone got 3 in a row and won the game
				if (count > 2) {
					// Set the winner and reset the game
					resetGame(userTurn);
				}
			}
		}
	}
	userTurn = !userTurn;
}

// Push the choice to the array
function addToArray(array, choice) {
	// Add the item to the array
	array.push(choice);
	// Sort the array
	array.sort(function (a, b) {
		return a - b;
	});

	// Check if you got an winning array, you can only win if you did 3 or more moves
	checkArrayForWin(array);
}

// Make a (stupid) AI choice
function makeAiMove(maybeAddDifficultHere) {
	// Haven't done anythin with the difficult yet
	// This is just a random move generator basicly
	// Get all the non clicked tiles for the AI
	nonClickedTiles = document.querySelectorAll('td.free');
	// Click a random tile out of the nonClickedTiles array
	tiles[nonClickedTiles[Math.floor(Math.random() * nonClickedTiles.length)].id - 1].click();
}

// Change the value of the tile clicked
function changeTileData(target, value, className) {
	target.innerHTML = value;
	target.classList.add(className);
}

// If a tile is clicked, excecute this function
function makeMove(event) {

	// Set the move
	moves++;

	// Get the id of the clicked button
	choice = event.target.id;

	// Set the target for the clicket item
	target = document.getElementById(choice);

	// Check if the tile is occupied
	if (target.classList.contains("occupied")) {
		// Give the player feedback
		alert("Dit vakje is al bezet!");
	}
	// If the tile is not occupied
	else {
		// Set the target to occupied
		target.className = "occupied";

		// Set the string to an integer
		choice = parseInt(choice, 10);

		// Set the turn
		if (userTurn) {
			changeTileData(target, "X", "X");
			addToArray(xTiles, choice);
		} else {
			changeTileData(target, "O", "O");
			addToArray(oTiles, choice);
		}

		// Check if tiles are full and there is still no winner
		if (moves >= 9 && game) {
			resetGame(false);
		}
	}
}

// Loop trough all the tiles to make them clickable
for (i = 0; i < 9; i++) {
	tiles[i].addEventListener('click', makeMove);
}

// checking each X seconds if the player made a move
var AiTimer = setInterval(function () {
	if (!userTurn && game) {
		makeAiMove(1);
	}
}, 500); // 1000 = 1 second