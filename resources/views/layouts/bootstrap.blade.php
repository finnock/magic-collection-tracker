<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Collection tracker application for the trading card game magic the gathering. Not associated with wizards of the coast or magic tm.">
    <meta name="author" content="Jan Oechsler">


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">

    <!-- Font Awesome (Icons) -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    {{-- Keyrune and Mana Font --}}
    <link href="/css/keyrune.css" rel="stylesheet" type="text/css" />
    <link href="/css/mana.css" rel="stylesheet" type="text/css" />

    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="/css/style.css">


    <title>Magic Collection Tracker</title>
</head>

<body>

@include('navbar')


@yield('container')

{{-- JQuery --}}
<script src="/js/jquery-3.1.1.min.js"></script>

<!-- Latest compiled and minified CSS -->
<script src="/js/bootstrap.min.js"></script>

{{-- Auto hiding navbar --}}
<script src="/js/jquery.bootstrap-autohidingnavbar.js"></script>
<script>$("nav.navbar-fixed-top").autoHidingNavbar();</script>

<!-- App.js compiled by laravel-mix -->
<script src="/js/app.js"></script>

</body>
</html>
