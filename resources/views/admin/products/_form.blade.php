<div class="row mt-1 g-5">
    <div class="col-md-6">
        <div class="form-floating form-floating-outline">
            {!! html()->text('title')->class('form-control')->id('title')->placeholder('Product title')->required()->value(old('title', $product->title ?? '')) !!}
            {!! html()->label('Title')->for('title') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating form-floating-outline">
            {!! html()->select('category_id', $categories ?? [], old('category_id', $product->category_id ?? ''))->class('select2 form-select')->id('category_id')->required() !!}
            {!! html()->label('Category')->for('category_id') !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating form-floating-outline">
            {!! html()->textarea('description')->class('form-control')->id('description')->placeholder('Description')->attributes(['style' => 'height: 120px'])->value(old('description', $product->description ?? '')) !!}
            {!! html()->label('Description')->for('description') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            {!! html()->number('regular_price')->class('form-control')->id('regular_price')->attribute('step', '0.01')->placeholder('0.00')->required()->value(old('regular_price', $product->regular_price ?? '')) !!}
            {!! html()->label('Regular Price')->for('regular_price') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            {!! html()->number('promotional_price')->class('form-control')->id('promotional_price')->attribute('step', '0.01')->placeholder('0.00')->value(old('promotional_price', $product->promotional_price ?? '')) !!}
            {!! html()->label('Promotional Price')->for('promotional_price') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            {!! html()->text('currency')->class('form-control')->id('currency')->placeholder('USD')->required()->value(old('currency', $product->currency ?? 'USD')) !!}
            {!! html()->label('Currency')->for('currency') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            {!! html()->number('tax_rate')->class('form-control')->id('tax_rate')->attribute('step', '0.01')->placeholder('0')->value(old('tax_rate', $product->tax_rate ?? '0')) !!}
            {!! html()->label('Tax Rate (%)')->for('tax_rate') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            {!! html()->number('shipping_width')->class('form-control')->id('shipping_width')->attribute('step', '0.01')->placeholder('Width')->value(old('shipping_width', $product->shipping_width ?? '')) !!}
            {!! html()->label('Shipping Width')->for('shipping_width') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            {!! html()->number('shipping_height')->class('form-control')->id('shipping_height')->attribute('step', '0.01')->placeholder('Height')->value(old('shipping_height', $product->shipping_height ?? '')) !!}
            {!! html()->label('Shipping Height')->for('shipping_height') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            {!! html()->number('shipping_weight')->class('form-control')->id('shipping_weight')->attribute('step', '0.01')->placeholder('Weight')->value(old('shipping_weight', $product->shipping_weight ?? '')) !!}
            {!! html()->label('Shipping Weight')->for('shipping_weight') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            {!! html()->number('shipping_fee')->class('form-control')->id('shipping_fee')->attribute('step', '0.01')->placeholder('0.00')->value(old('shipping_fee', $product->shipping_fee ?? '')) !!}
            {!! html()->label('Shipping Fee')->for('shipping_fee') !!}
        </div>
    </div>
</div>


