<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title>{{ config('app.name') }}</title>
</head>
<body>
<div id="app">
</div>
<script src="{{ mix('js/main.js') }}"></script>
</body>
</html>
