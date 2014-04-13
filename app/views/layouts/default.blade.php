<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ $title }}</title>
        <meta name="viewport" content="width=device-width">
        <link href="//fonts.googleapis.com/css?family=Droid+Sans:400,700" 
            rel="stylesheet" type="text/css">
        
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/style.css') }}
        {{ HTML::style('css/flexslider.css') }}
        {{ HTML::script('js/jquery-1.9.1.js') }}
        {{ HTML::script('js/jquery.flexslider.js') }}
    </head>
    <body class="{{ $class }}">
        <div class="container">
            <div class="row-fluid header">
                <div class="span4 logo">
                    <a href="{{ URL::to('/') }}">
                        <img class="logo" src="{{ URL::asset('/img/logo.png')}}" />
                    </a>
                </div>
                <div class="span6 menu">
                    <ul>
                        <li>
                            <a href="#popup" data-toggle="modal">
                                Create Foldagram
                            </a>
                        </li>
                        <li>
                            <a href="#">Purchase Credits</a>
                        </li>
                        <li><a href="#">Cart</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                    </ul>
                </div>
                <div class="span2 social">
                    <a href="https://www.facebook.com/TheFoldagram" target="_blank">
                        <img class="facebook" src="{{ URL::to('/') }}/img/img_trans.png" />
                    </a>
                    <a href="https://twitter.com/thefoldagram" target="_blank">
                        <img class="twit" src="{{ URL::to('/') }}/img/img_trans.png" />
                    </a>
                    <a href="https://pinterest.com/thefoldagram" target="_blank">
                        <img class="ping" src="{{ URL::to('/') }}/img/img_trans.png" />
                    </a>
                </div>                              
            </div>
            @yield('inner-banner')
            <div class="row-fluid content">
                @yield('content')
            </div>
            <div class="row-fluid subscribe-form">
                @if($errors->any())
                    <ul>
                        {{implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                @endif
                <div class="span12 subscribe-content">
                    
                    {{ Form::open(array('route' => 'post_subscribe')) }}
                        {{ Form::label('label', 'Sign Up for our Newsletter and Updates!') }}
                        {{ Form::text('email', null, array('class' => 'input-large', 'placeholder' => '')) }}
                        {{ Form::submit('Subscribe') }}
                    {{ Form::close() }}
                </div> 
            </div>
            <div class="row-fluid footer">
                <div class="span8 footer-menu">
                    <ul>
                        <li><a href="#">Contact</a></li>
                        <li>{{ link_to_route('about', 'About Us') }}</li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                    </ul>
                </div>
                <div class="span4 copyright">
                    <h4>Foldagram is patent pending</h4>
                    <p>&copy;Copyright All Encompassing Productions llc, 2012</p>
                </div> 
            </div>
        </div><!-- End Container -->
    </body>
</html>
