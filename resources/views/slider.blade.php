<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blueprint: Background Slideshow</title>
    <meta name="description" content="Blueprint: Background Slideshow"/>
    <meta name="keywords"
          content="blueprint, background image slideshow, fullscreen slideshow, jquery, fullscreen image, web development"/>
    <meta name="author" content="Codrops"/>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{url("css/default.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{url("css/component.css")}}"/>
    <script src="{{url("js/modernizr.custom.js")}}"></script>
</head>
<body>
<div class="container">
    <header class="clearfix">
        <span style="display: none">Blueprint</span>
        <h1 style="display: none">Background Slideshow</h1>
        <nav style="display: none">
            <a href="http://tympanus.net/Blueprints/ResponsiveFullWidthGrid/" class="icon-arrow-left"
               data-info="previous Blueprint">Previous Blueprint</a>
            <a href="http://tympanus.net/codrops/?p=14667" class="icon-drop" data-info="back to the Codrops article">back
                to the Codrops article</a>
        </nav>
    </header>
    <div class="main">
        <ul id="cbp-bislideshow" class="cbp-bislideshow">
            @foreach ($slides as $slide)
                <li><img src="{{ $slide->getUrl() }}" alt="image01"/></li>
            @endforeach


        </ul>
        <div id="cbp-bicontrols" class="cbp-bicontrols" style="display: none">
            <span class="cbp-biprev"></span>
            <span class="cbp-bipause"></span>
            <span class="cbp-binext"></span>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- imagesLoaded jQuery plugin by @desandro : https://github.com/desandro/imagesloaded -->
<script src="{{url("js/jquery.imagesloaded.min.js")}}"></script>
<script src="{{url("js/cbpBGSlideshow.min.js")}}"></script>
<script>
    $(function () {
        cbpBGSlideshow.init();
    });
</script>
</body>
</html>
