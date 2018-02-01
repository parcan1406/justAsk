<div class="modal" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                @if(isset($msg))
                    <p>{{ $msg }}</p>
                @else
                    <p>Are you sure you, want to delete?</p>
                @endif
            </div>
            <div class="modal-footer">
                <form action="" method="POST" class="delete-form">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                </form>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@section('script')
    @parent
    <script>
        $(document).on('click', '.delete-btn', function () {
            let modal = $('#delete-modal');
            modal.find('form').attr('action', $(this).data('url'));
        });
    </script>
@endsection