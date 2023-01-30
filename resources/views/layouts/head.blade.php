<!-- Title -->
<title> Valex -  Premium dashboard ui bootstrap rwd admin html5 template </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
{{-- fontawsome --}}
    <link rel="stylesheet" href="{{asset("assets/frontend/css/fontawsome/all.min.css")}}">
    {{-- <link
      rel="stylesheet"
      data-purpose="Layout StyleSheet"
      title="Web Awesome"

      href="/css/app-wa-0b825fee9ab73841eef6e87ad8809c51.css?vsn=d"
    > --}}

      <link
        rel="stylesheet"

        href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css"
      >

      <link
        rel="stylesheet"

        href="https://site-assets.fontawesome.com/releases/v6.2.1/css/sharp-solid.css"
      >

<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">


@if (LaravelLocalization::getCurrentLocale() == 'ar')
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
    <!--- Style css -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
@else 
    <link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
    <!--- Style css -->
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet">

@endif
@yield('css')
<!-- Sidemenu css -->

<!---font ---->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;900&display=swap" rel="stylesheet">