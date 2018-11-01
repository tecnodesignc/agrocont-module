<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.name") ? ' has-error' : '' }}'>
        @php $oldName = $lot->translate($lang)->name ?? ''@endphp
        {!! Form::label("{$lang}[name]", trans('agrocont::lots.form.name')) !!}
        {!! Form::text("{$lang}[name]", old("$lang.name",$oldName), ['class' => 'form-control', 'placeholder' => trans('suscriptions::products.form.name')]) !!}
        {!! $errors->first("$lang.name", '<span class="help-block">:message</span>') !!}
    </div>
</div>
