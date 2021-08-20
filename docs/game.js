// global variables initializing
var player = 1;
var move = -1;
var isFinished = false;
var boardArray = [-1,-1,-1,-1,-1,-1,-1,-1,-1];

var keys = document.querySelectorAll('#board span');
var finalRes = document.getElementById("finalRes");

// check for a win according to the player
var isWin = function(arr,p) {
    return (arr[0] === p && arr[1] === p && arr[2] === p) ||
           (arr[3] === p && arr[4] === p && arr[5] === p) ||
           (arr[6] === p && arr[7] === p && arr[8] === p) ||
           (arr[0] === p && arr[3] === p && arr[6] === p) ||
           (arr[1] === p && arr[4] === p && arr[7] === p) ||
           (arr[2] === p && arr[5] === p && arr[8] === p) ||
           (arr[0] === p && arr[4] === p && arr[8] === p) ||
           (arr[2] === p && arr[4] === p && arr[6] === p);
};

// check the ability to pass a movement
var canPass = function() {
    for(var i = 0;i < boardArray.length;i++) {
        if(boardArray[i] === -1)
            return true;
    }
    return false;
};

// count (-1)s as the size of new array
var arraySizeCounter = function(arr){
    var count = 0;
    for(var i = 0;i < arr.length;i++) {
        if(arr[i] === -1)
            count++;
    }
    return count;
};

// mapping array b into array a
var mappingArray = function(a,b){
    for(var i = 0,j = 0;i < a.length;i++) {
        if(a[i] === -1) {
            a[i] = b[j];
            j++;
        }
    }
    return a;
};

// increment the array by 1 as a binary number
var incrementArray = function(arr){
    var co = 1;
    for(var i = arr.length - 1;i >= 0;i--) {
        if(co === 0)
            break;
        var tmp = arr[i];
        arr[i] = (arr[i] + co) % 2;
        co = ~~((tmp + co) / 2);
    }
    return arr;
};

// count the winning chances for an array
var winningChances = function(arr,player) {
    var count = 0; var p = [];
    var x = this.arraySizeCounter(arr); // number of (-1)s
    var posibilities = Math.pow(2,x);
    
    for(var h = 0;h < x;h++) {
        p[h] = 0;
    }
    for(var i = 0;i < posibilities;i++) {
        var mappedArray = mappingArray(arr.slice(0), p);
        if(this.isWin(mappedArray, player)) {
            count++;
        }
        p = this.incrementArray(p);
    }
    return [posibilities,count];
};

// check for winner
function checkWinner() {
    var x = boardArray.slice(0);
    if(isWin(x,1)) {
        isFinished = true;
        finalRes.innerHTML = "You Won !!";
    } else if(isWin(x,0)) {
        isFinished = true;
        finalRes.innerHTML = "You Lost !!";
    } else {
        for(var i = 0;i < x.length;i++) {
            if(x[i] === -1) break;
            else if(i === x.length - 1) {
                isFinished = true;
                finalRes.innerHTML = "Tie Tie !!";
            }
        }
    }
};

// find the next move according to the player
var nextMove = function(player){
    var arr = boardArray.slice(0);
    var posList = [];
    
    // finding best chance
    var mv0 = 0, max0 = 0;
    for(var i = 0;i < arr.length;i++) {
        if(arr[i] === -1) {
            var test = arr.slice(0);
            test[i] = player;
            var k = winningChances(test,player);
            
            if(k[1] >= max0) {
                if(k[1] === max0) {
                    posList.push(i);
                } else {
                    posList = [];
                    posList.push(i);
                }
                max0 = k[1];
            }
        }
    }
    
    mv0 = posList[Math.floor(Math.random() * posList.length)];
    
    // risk analysing
    var t = arr.slice(0);
    t[mv0] = player;
    var mv1 = 0, max1 = 0;
    for(var j = 0;j < t.length;j++) {
        if(t[j] === -1) {
            var test = t.slice(0);
            test[j] = 1;
            var l = winningChances(test, 1);
            if(l[1] >= max1) {
                max1 = l[1]; mv1 =j;
            }
        }
    }
    
    if(!isWin(t, 0)) {
        t[mv1] = 1;
        if(this.isWin(t, 1))
            mv0 = mv1;
    }
        
    return mv0;
};

// display the board
function displayBoard(){
    var arr = boardArray.slice(0);
    for(var k = 0;k < keys.length;k++) {
        for(var m = 0;m < arr.length;m++) {
            var d = keys[k].innerHTML - 1;
            if(arr[d] === 1) {
                keys[k].innerHTML = "X";
                keys[k].classList.add('btnClicked');
            }
            else if(arr[d] === 0){
                keys[k].innerHTML = "O";
                keys[k].classList.add('btnClicked');
            }
        }
    }            
};

// main function
function main() {
    for(var i = 0;i < keys.length;i++) {
        keys[i].onclick = function(e) {
            for(var j = 0;j < boardArray.length;j++) {
                var index = this.innerHTML - 1;
                if(boardArray[index] === -1 && player === 1 && !isFinished) {
                    checkWinner();
                    if(canPass() && !isFinished) {
                        move = index;
                        boardArray[move] = 1;
                    }
                    checkWinner();
                    if(canPass() && !isFinished) {
                        move = nextMove(0);
                        boardArray[move] = 0;
                    }
                    checkWinner();
                    displayBoard();
                    
                    break;
                }
            }
        };
    } 
}

main();
