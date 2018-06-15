@if(session('Message'))
 <div id="SuccessAlert" class="col-xl-12">
     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     <strong>{{ session('Message') }}</strong>
  </div>
@endif