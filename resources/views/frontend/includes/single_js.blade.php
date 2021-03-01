<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        $('#btn-submit').on('click', function () {
            const url = "{{ route('frontend.auth.store-comment') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    text: $('#message').val(),
                    article_id: $('#articleId').val(),
                },
                dataType: 'json',
                success: function (result) {
                    $('#message').val('');
                    var markup = '<div class="media">';
                    markup += '<a class="pull-left" href="#"><img class="media-object" src="'+ result.avatar +'" alt=""></a>';
                    markup += '<div class="media-body">';
                    markup += '<h4 class="media-heading">'+result.name+'</h4>';
                    markup += '<p>'+result.content+'</p>';
                    markup += '<ul class="list-unstyled list-inline media-detail pull-left">';
                    markup += '<li><i class="fa fa-calendar"></i>'+result.date+'</li>';
                    markup += '</ul>';
                    markup += '</div>'
                    markup += '</div>'
                    $('#comment-area').append(markup);
                },
            });

        });
    });


</script>
