@extends('layouts.app')

@section('title')
    Bookings :: New :: @parent
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add new booking
                    </div>
                    <div class="panel-body">


                        {!! Form::open(array('route' => 'bookingStore', 'method' => 'post', 'class' =>
                        'form-horizontal'))
                        !!}


                        {!! Form::hidden('platform_id', 1) !!}
                        {!! Form::hidden('booking_status_id', 1) !!}

                        <div class="form-group">
                            {!! Form::label('listing_id', 'Listing', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-3">
                                {!! Form::select('listing_id', $listings, \Request::old('listing_id'), array('class' =>
                                'form-control')) !!}
                                {!! $errors->first('listing_id', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>
                            {!! Form::label('people', 'Guests', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-1">
                                {!! Form::number('people', \Request::old('people'), $attributes = array('class' =>
                                'form-control',
                                'id' => 'people', 'placeholder' => '2')) !!}
                                {!! $errors->first('people', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>

                            {!! Form::label('guest_name', 'Name', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-4">
                                {!! Form::text('guest_name', \Request::old('guest_name'), $attributes = array('class' =>
                                'form-control', 'id' => 'guest_name', 'placeholder' => 'John Doe')) !!}
                                {!! $errors->first('guest_name', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('guest_phone', 'Mobile', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-4 col-rg-offset-1">
                                {!! Form::text('guest_phone', \Request::old('guest_phone'), $attributes = array('class' =>
                                'form-control', 'id' => 'guest_phone', 'placeholder' => '')) !!}
                                {!! $errors->first('guest_phone', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>

                            {!! Form::label('guest_email', 'Email', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-4 col-rg-offset-1">
                                {!! Form::text('guest_email', \Request::old('guest_email'), $attributes = array('class' =>
                                'form-control', 'id' => 'guest_email', 'placeholder' => '')) !!}
                                {!! $errors->first('guest_email', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>

                            {!! Form::label('guest_country', 'Country', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-1">
                                {!! Form::text('guest_country', \Request::old('guest_country'), $attributes = array('class'
                                => 'form-control', 'id' => 'guest_country', 'placeholder' => 'DE')) !!}
                                {!! $errors->first('guest_country', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>
                        </div>


                        <div class="form-group">
                            {!! Form::label('inquiry_date', 'Inquiry', array('class' => 'col-md-1 control-label'))
                            !!}
                            <div class="col-md-2">
                                {!! Form::date('inquiry_date', \Request::old('inquiry_date'), $attributes = array('class'
                                => 'form-control', 'id' => 'inquiry_date', 'placeholder' => '2014-12-01')) !!}
                                {!! $errors->first('inquiry_date', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>
                            {!! Form::label('arrival_date', 'Arrival', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-2">
                                {!! Form::date('arrival_date', \Request::old('arrival_date'), $attributes = array('class'
                                => 'form-control', 'id' => 'arrival_date', 'placeholder' => '2014-12-01')) !!}
                                {!! $errors->first('arrival_date', '
                                <div class="note note-error">:message</div>
                                ') !!}

                                {!! Form::label('arrival_time', 'Arrival time', array('class' => 'sr-only')) !!}
                                {!! Form::text('arrival_time', \Request::old('arrival_time'), $attributes = array('class'
                                => 'form-control', 'id' => 'arrival_time', 'placeholder' => '18:00')) !!}
                                {!! $errors->first('arrival_time', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>

                            {!! Form::label('departure_date', 'Departure', array('class' => 'col-md-1 control-label'))
                            !!}
                            <div class="col-md-2">
                                {!! Form::date('departure_date', \Request::old('departure_date'), $attributes =
                                array('class' => 'form-control', 'id' => 'departure_date', 'placeholder' =>
                                '2014-12-01')) !!}
                                {!! $errors->first('departure_date', '
                                <div class="note note-error">:message</div>
                                ') !!}

                                {!! Form::label('departure_time', 'Departure time', array('class' => 'sr-only'))
                                !!}
                                {!! Form::text('departure_time', \Request::old('departure_time'), $attributes =
                                array('class' => 'form-control', 'id' => 'departure_time', 'placeholder' => '18:00'))
                                !!}
                                {!! $errors->first('departure_time', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>

                        </div>


                        <div class="form-group">
                            {!! Form::label('price_total', 'Price', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-2">
                                {!! Form::text('price_total', \Request::old('price_total'),
                                $attributes =
                                array('class' => 'form-control', 'id' => 'price_total', 'placeholder' =>
                                '30'))
                                !!}
                                {!! $errors->first('price_total', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::text('currency', \Request::old('currency'),
                                $attributes =
                                array('class' => 'form-control', 'id' => 'currency', 'placeholder' =>
                                'EUR'))
                                !!}
                                {!! $errors->first('currency', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>

                            {!! Form::label('comment', 'Comment', array('class' => 'col-md-1 control-label')) !!}

                            <div class="col-md-4">
                                {!! Form::textarea('comment', \Request::old('comment'), $attributes = array('class' =>
                                'form-control', 'id' => 'comment', 'placeholder' => 'Comment', 'rows' => 3)) !!}
                                {!! $errors->first('comment', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>



                        </div>

                        <div class="form-group">

                            {!! Form::label('airbnb_conversation_id', 'AirBnB Conversation ID', array('class' =>
                            'col-md-2 control-label')) !!}
                            <div class="col-md-3">
                                {!! Form::text('airbnb_conversation_id', \Request::old('airbnb_conversation_id'),
                                $attributes =
                                array('class' => 'form-control', 'id' => 'airbnb_conversation_id', 'placeholder' =>
                                '1id8x912'))
                                !!}
                                {!! $errors->first('airbnb_conversation_id', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>

                            {!! Form::label('airbnb_booking_code', 'AirBnB Booking Code', array('class' =>
                            'col-md-2 control-label')) !!}
                            <div class="col-md-3">
                                {!! Form::text('airbnb_booking_code', \Request::old('airbnb_booking_code'),
                                $attributes =
                                array('class' => 'form-control', 'id' => 'airbnb_booking_code', 'placeholder' =>
                                'WXW78D'))
                                !!}
                                {!! $errors->first('airbnb_booking_code', '
                                <div class="note note-error">:message</div>
                                ') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-1">
                                {!! Form::submit('Save new booking', array('class' => 'btn btn-primary')) !!}
                            </div>
                            <div class="pull-right"><a class="btn btn-link" href="{!! route('bookings') !!}"><i
                                            class="fa fa-arrow-left"
                                            aria-hidden="true"></i>
                                        {{ trans('bookings/edit.link_text_back_to_overview') }}</a></div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop