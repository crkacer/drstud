  function __log(e, data) {
    log.innerHTML += "\n" + e + " " + (data || '');
  }

  var audio_context;
  var recorder;

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    __log('Media stream created.' );
  __log("input sample rate " +input.context.sampleRate);

    // Feedback!
    //input.connect(audio_context.destination);
    __log('Input connected to audio context destination.');

    recorder = new Recorder(input, {
                  numChannels: 1
                });
    __log('Recorder initialised.');
  }

  var countdownTimer;
  function startRecording(button) {
    recorder && recorder.record();
    button.disabled = true;
    button.nextElementSibling.disabled = false;
    countdownTimer = setInterval('secondPassed()', 1000);
    __log('Recording...');
  }

  function stopRecording(button) {
    recorder && recorder.stop();
    button.disabled = true;
    button.previousElementSibling.disabled = false;
    clearInterval(countdownTimer);
    document.getElementById('btnUpload').disabled = false;
    document.getElementById('countdown').innerHTML = "Stopped!"
    __log('Stopped recording.');

  }



  var student = document.getElementById("studentValue");
  var studentid = parseInt(student.textContent);
  var stid = String(studentid);

  var subject = document.getElementById("subject-value");
  var subjectid = parseInt(subject.textContent);
  var sid = String(subjectid);

  // var sname;
  // var name = document.getElementById("studentName");
  // if (name) {
  //   sname = name.value;
  // } else {
  //   sname = "Demo";
  // }
  var sname = "Demo Student";
  // var questionstr;
  // var q = document.getElementById("question-value");
  // if (q != null) {
  //   questionstr = q.value;
  // } else {
  //   questionstr = "nil";
  // }

  var q = document.getElementById("question-value");
  var qq = parseInt(q.textContent);
  var questionstr = String(qq);

  function sqlInsert(studentid) {
    console.log(sname);
    $.ajax({
        type: "POST",
        url: "design700/assets/scripts/upload-sql.php",
        data: { student: stid, subject: sid, stuname: sname, question: questionstr}
          }).done(function(data) {
        console.log(data);
      });
  }
    function uploadRecording(button) {
    // create WAV download link using audio data blob
    createDownloadLink();
    sqlInsert();
    recorder.clear();
  }

  var div = document.getElementById("timer-value");
  var seconds = parseInt(div.textContent);

  function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;  
    }
    document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('btnUpload').disabled = false;
        document.getElementById('countdown').innerHTML = "Expired!";
        stopRecording(document.getElementById('btnStop'));
    } else {
        seconds--;
    }
}
 


  function createDownloadLink() {
    recorder && recorder.exportWAV(function(blob) {
      /*var url = URL.createObjectURL(blob);
      var li = document.createElement('li');
      var au = document.createElement('audio');
      var hf = document.createElement('a');

      au.controls = true;
      au.src = url;
      hf.href = url;
      hf.download = new Date().toISOString() + '.wav';
      hf.innerHTML = hf.download;
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);*/
    });
  }

  window.onload = function init() {
    try {
      // webkit shim
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);
      window.URL = window.URL || window.webkitURL;

      audio_context = new AudioContext;
      __log('Audio context set up.');
      __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
      alert('No web audio support in this browser!');
    }

    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      __log('No live audio input: ' + e);
    });
  };