document.addEventListener('DOMContentLoaded', function () {
  // Animate credibility bars
  document.querySelectorAll('.credibility-track').forEach(function(track){
    var val = parseInt(track.dataset.cred, 10) || 0;
    var fill = track.querySelector('.credibility-fill');
    // clamp
    if(val < 0) val = 0; if(val > 100) val = 100;
    // delay to allow paint
    setTimeout(function(){ fill.style.width = val + '%'; }, 120);
  });

  // Copy buttons (referral code/link)
  document.querySelectorAll('.btn-copy').forEach(function(btn){
    btn.addEventListener('click', function(){
      var text = btn.dataset.copy || '';
      if(!text) return;
      if(navigator.clipboard && window.isSecureContext){
        navigator.clipboard.writeText(text).then(function(){
          // simple feedback; app may use nicer toasts
          alert('Copied to clipboard');
        });
      } else {
        var tmp = document.createElement('input');
        document.body.appendChild(tmp);
        tmp.value = text; tmp.select();
        try { document.execCommand('copy'); alert('Copied to clipboard'); } catch(e){}
        document.body.removeChild(tmp);
      }
    });
  });

  // Avatar preview handler exposed globally for the file input onchange
  window.previewAvatar = function(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        var preview = document.getElementById('avatarPreview');
        if(preview){
          preview.style.backgroundImage = 'url(' + e.target.result + ')';
          preview.style.backgroundSize = 'cover';
          preview.style.backgroundPosition = 'center';
          preview.textContent = '';
        }
      };
      reader.readAsDataURL(input.files[0]);
    }
  };
});
