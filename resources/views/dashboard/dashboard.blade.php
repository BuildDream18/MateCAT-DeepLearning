@extends('site.global')

@section('title','Dashboard')
@section('page')

    <div class="site-wrapper-reveal">
        <div class="contact-us-section-wrappaer section-space--pt_100 section-space--pb_70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-lg-12">
                        <div class="conact-us-wrap-one mb-30">
                            <h3 class="heading">Dashboard, Welcome {{auth()->user()->name}}</h3>
                        </div>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link ">My Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ">Assigned Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Update Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/logout') }}"
                                   class="nav-link"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

