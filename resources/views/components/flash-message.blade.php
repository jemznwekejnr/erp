@if(session()->has('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
  class="fixed rounded top-0 left-1/2 transform -translate-x-1/2  text-white m-3 p-3" style="background-color: #1434A4;">
  <p>
    {{session('message')}}
  </p>


</div>




@endif

