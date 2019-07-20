@extends('layouts.master')
@section('content')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{asset('assets/img/restaurant.jpg')}}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading main-text">
              <h1>Contact Me</h1>
              <span class="subheading">Have questions? I have answers.</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container main-text">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
          <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
          <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
          <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
          <form method="POST" action="{{ route('contactUs') }}" name="sentMessage" id="contactForm" novalidate>
          @csrf
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Name</label>
                <input name="name" type="text" class="form-control form-text-fields round-corners {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input name="email" type="email" class="form-control form-text-fields round-corners {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Phone Number</label>
                <input name="contact_number" type="tel" class="form-control form-text-fields round-corners {{ $errors->has('contact_number') ? ' is-invalid' : '' }}" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('contact_number') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Message</label>
                <textarea name="content" rows="5" class="form-control summernote round-corners {{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary rounded-corners" id="sendMessageButton"><i class="icon icon-paper-plane">&nbsp;Send</i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('/admin/assets/js/jquery.fittext.js') }}"></script>
<script type="text/javascript">
    $(".responsive_headline").fitText(maxFontSize: '10em');
</script>
@endsection