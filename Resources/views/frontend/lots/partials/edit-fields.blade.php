<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        @php $oldName = $product->translate($lang)->slug ?? ''@endphp
        {!! Form::label("{$lang}[name]", trans('suscriptions::products.form.name')) !!}
        {!! Form::text("{$lang}[name]", old("$lang.name",$oldName), ['class' => 'form-control', 'placeholder' => trans('suscriptions::products.form.name')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
</div>
