var CURRENTTV = 1;

var TYPE_TV_AD = 575;
var TYPE_UPCOMING_EVENT = 574;
var TYPE_PAST_EVENT = 576;

Array.prototype.clean = function(deleteValue) {
  for (var i = 0; i < this.length; i++) {
    if (this[i] == deleteValue) {         
      this.splice(i, 1);
      i--;
    }
  }
  return this;
};

Array.prototype.shuffle = function(){
    var counter = this.length, temp, index;

    // While there are elements in the array
    while (counter > 0) {
        // Pick a random index
        index = (Math.random() * counter--) | 0;

        // And swap the last element with it
        temp = this[counter];
        this[counter] = this[index];
        this[index] = temp;
    }
};

function randomFromInterval(from,to)
{
    return Math.floor(Math.random()*(to-from+1)+from);
}
