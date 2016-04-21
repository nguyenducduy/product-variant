<!doctype html>
<html>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="{{ static_url('plugins/detectie/html5shiv.js') }}"></script>
      <script src="{{ static_url('plugins/detectie/respond.min.js') }}"></script>
    <![endif]-->
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>
            {% block title %}{% endblock %} - {{ config.global.title }}
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,700' rel='stylesheet' type='text/css'/>
    	<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'/>
        <link rel="shortcut icon" type="image/x-icon" href="{{ static_url('favicon.ico') }}">
        <link rel="icon" type="image/x-icon" href="{{ static_url('favicon.ico') }}">
        <link href="{{ static_url('min/index.php?g=cssDefaultCoreSite&rev=' ~ config.global.version.css) }}" rel="stylesheet" type="text/css">
        {% block css %}{% endblock %}
        <script type="text/javascript" src="{{ static_url('plugins/jquery/jquery-1.10.2.min.js') }}"></script>
    </head>

    <body>
        <div class="wrap">
            {% include '../../Core/View/Layout/Default/site-header.volt' %}
            <div id="content">
                {% block content %}{% endblock %}
            </div>
            {% include '../../Core/View/Layout/Default/site-footer.volt' %}
        </div>
    </body>
    <script type="text/javascript" src="{{ static_url('plugins/boostrapv3/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('min/index.php?g=jsDefaultCoreSite&rev=' ~ config.global.version.js) }}"></script>
</html>


{% if config.global.profiler === true %}
{{ helper('profiler', 'core').render() }}
{% endif %}
