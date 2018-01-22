@if(isset($delete) && $delete)
<!-- delete -->
<div class="message-box animated fadeIn" id="message-box-delete">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-trash-o"></span> Подтверждение удаления</div>
            <div class="mb-content">
                <p>Вы собираетесь удалить выбранные {{ isset($item)? $item : 'Item' }}, Вы уверены?</p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default pull-right mb-control-close">Закрыть</button>
                <button style="margin-right:5px;" class="btn btn-danger pull-right mb-control-action">Удалить</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete -->
@endif