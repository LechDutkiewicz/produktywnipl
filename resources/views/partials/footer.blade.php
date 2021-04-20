
@if(!is_404())
@include('modules.contact')
@endif

@if(is_404())
@component('components.skewy-container', ['variant' => 'white', 'classes' => 'footer-404'])
@endif
<footer class="content-info">
  <div class="container container--footer container--padding">
    <div class="row">
      <div class="col-sm-6 content-info__copyright">
        <p>Copyright by <strong><a href="http://produktywni.pl/">Produktywni.pl</a></strong></p>
      </div>
      <div class="col-sm-6 content-info__authors">
        <p>Design by <strong><a href="http://projectpeople.pl/">Joanna Ostafin @ProjectPeople.pl</a></strong></p>
      </div>
    </div>
  </div>
</footer>
@if(is_404())
@endcomponent
@endif