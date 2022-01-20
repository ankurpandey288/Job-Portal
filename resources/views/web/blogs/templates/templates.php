<script id="blogCommentTemplate" type="text/x-jsrender">

<li id="li-comment-1680">
    <div class="comments-box" id="comment-1680">
        <div class="comments-avatar">
            <img src="{{:image}}" alt="user-image">
        </div>
        <div class="comments-text">
            <div class="avatar-name d-flex justify-content-between">
                <h5 class="d-flex">{{:commentName}}
                <?php if (getLoggedInUser()) { ?>
                <a href="javascript:void(0)" class="edit-comment-btn edit-btn action-btn" data-id="{{:id}}" title="<?php echo __('messages.common.edit') ?>">
                   <i class="fa fa-edit edit-comment text-danger"></i>
                </a>
                <a href="javascript:void(0)" class="action-btn delete-comment-btn" data-id="{{:id}}" title="<?php echo __('messages.common.delete') ?>">
                    <i class="fa fa-trash delete-comment text-warning"></i>
                </a>
                <?php } ?>
                </h5>
                <span class="date-color float-right">{{:commentCreated}}</span>
            </div>
            <p id="comment-{{:id}}">{{:comment}}</p>
        </div>
    </div>
    <hr class="last-comment-border">
</li>

</script>
