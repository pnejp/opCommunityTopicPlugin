<?php use_helper('opCommunityTopic'); ?>
<?php if ($commentPager->getNbResults()) : ?>
<div class="dparts commentList"><div class="parts">
<div class="partsHeading">
<h3><?php echo __('Comments', array(), 'form_community') ?></h3>
</div>

<?php ob_start() ?>
<?php op_include_pager_navigation($commentPager, '@communityTopic_show?page=%d&id='.$communityTopic->getId()); ?>
<?php $pagerNavi = ob_get_contents() ?>
<?php ob_end_flush() ?>
<?php foreach ($commentPager->getResults() as $comment): ?>
<dl>
<dt><?php echo nl2br(op_format_date($comment->getCreatedAt(), 'XDateTimeJaBr')) ?></dt>
<dd>
<div class="title">
<p class="heading"><strong><?php echo $comment->getNumber() ?></strong>:
<?php if ($_member = $comment->getMember()) : ?> <?php echo op_community_topic_link_to_member($_member) ?><?php endif; ?>
<?php if ($comment->isDeletable($sf_user->getMemberId())): ?>
 <?php echo link_to(__('Delete'), '@communityTopic_comment_delete_confirm?id='.$comment->getId()) ?>
<?php endif; ?>
</p>
</div>
<div class="body">
<?php
// sfReversibleDoctrinePager taints record state. It should be clean for working browsing relations
$comment->state(Doctrine_Record::STATE_CLEAN);
$images = $comment->getImages();
?>
<?php if (count($images)): ?>
<ul class="photo">
<?php foreach ($images as $image): ?>
<li><a href="<?php echo sf_image_path($image->File) ?>" target="_blank"><?php echo image_tag_sf_image($image->File, array('size' => '120x120')) ?></a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<p class="text">
<?php echo op_url_cmd(nl2br($comment->getBody())) ?>
</p>
</div>
<!--Like Plugin -->
<div class="like" style="display: none;">
<span class="like-wrapper" data-like-id="<?php echo $comment->getId() ?>" data-like-target="t" member-id="<?php echo $comment->member_id ?>">
<span class="like-post">いいね！</span>
<span class="like-cancel">いいね！を取り消す&nbsp;</span>
<span class="like-you">あなたが「いいね！」と言っています。</span><br />
<a class="like-list" href="#likeModal" data-toggle="modal"></a>
<div class="like-list-member"></div>
<span class="like-friend-list"></span>
</span>
</div>
</dd>
</dl>
<?php endforeach; ?>

<?php echo $pagerNavi ?>

</div>
</div>
<?php endif; ?>

<script id="LikelistTemplate" type="text/x-jquery-tmpl">
<table>
<tr style="padding: 2px;">
<td style="width: 48px; padding: 2px;"><a href="${profile_url}"><img src="${profile_image}" width="48"></a></td>
<td style="padding: 2px;"><a href="${profile_url}">${name}</a></td>
</tr>
</table>
</script>

<div id="likeModal" class="modal hide">
  <div class="modal-header">
    <h1>「いいね！」と言っている人</h1>
  </div>
  <div class="like-modal-body">
  </div>
  <div class="modal-footer">
    <a href="#" class="btn close" data-dismiss="modal" aria-hidden="true">閉じる</a>
  </div>
</div>
