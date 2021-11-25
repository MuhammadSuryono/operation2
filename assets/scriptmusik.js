
var timer;
var percent = 0;
var audio = document.getElementById("audio");
audio.addEventListener("playing", function(_event) {
  var duration = _event.target.duration;
  advance(duration, audio);
});
audio.addEventListener("pause", function(_event) {
  clearTimeout(timer);
});
var advance = function(duration, element) {
  var progress = document.getElementById("progress");
  increment = 10/duration
  percent = Math.min(increment * element.currentTime * 10, 100);
  progress.style.width = percent+'%'
  startTimer(duration, element);
}
var startTimer = function(duration, element){ 
  if(percent < 100) {
    timer = setTimeout(function (){advance(duration, element)}, 100);
  }
}

function togglePlay (e) {
  e = e || window.event;
  var btn = e.target;
  if (!audio.paused) {
    audio.pause();
    isPlaying = false;
	var doc = document.getElementById("togglePlay");
	doc.classList.remove('fa-pause-circle');
	doc.classList.add('fa-play-circle');
  } else {
    audio.play();
    isPlaying = true;
	var doc = document.getElementById("togglePlay");
	doc.classList.remove('fa-play-circle');
	doc.classList.add('fa-pause-circle');
  }
}
