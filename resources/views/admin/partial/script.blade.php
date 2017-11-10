<!-- Vendor JS -->
<script src="{{ asset("/assets/js/vendor.js")}}"></script>
<script src="{{ asset("/assets/js/admin.js")}}"></script>
<script src="{{ asset("/assets/js/backend/app.js")}}"></script> 
<!--
    IE8 support, see AngularJS Internet Explorer Compatibility http://docs.angularjs.org/guide/ie
    For Firefox 3.6, you will also need to include jQuery and ECMAScript 5 shim
-->
<!-- [if lt IE 9] -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.2.0/es5-shim.js"></script>
    <script>
      document.createElement('ui-select');
      document.createElement('ui-select-match');
      document.createElement('ui-select-choices');
    </script>
<!--[endif]-->


