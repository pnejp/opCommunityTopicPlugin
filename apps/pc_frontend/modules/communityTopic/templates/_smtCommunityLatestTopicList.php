<?php $acl = opCommunityTopicAclBuilder::buildCollection($community, array($sf_user->getMember())) ?>

<?php if ($acl->isAllowed($sf_user->getMemberId(), null, 'view')): ?>
<?php
use_helper('Javascript', 'opUtil', 'opAsset');
op_smt_use_javascript('/opCommunityTopicPlugin/js/moment.min.js', 'last');
op_smt_use_javascript('/opCommunityTopicPlugin/js/lang/ja.js', 'last');
op_smt_use_javascript('/opCommunityTopicPlugin/js/gadget.js', 'last');
?>
<script id="topicEntry" type="text/x-jquery-tmpl">
<div class="row">
  <div class="span3">${$item.calcTimeAgo()}</div>
  <div class="span9"><a href="<?php echo public_path('communityTopic')?>/${id}">${name}</a> (${community_name})</div>
</div>
</script>

<script type="text/javascript">
$(function(){
  var params = {
    apiKey: openpne.apiKey,
    format: 'mini',
    target: 'community',
    target_id: <?php echo $communityId ?>,
    count: 4
  }

  gadget.search(params, 'topic');
})
</script>

<hr class="toumei" />
<div class="row">
  <div class="gadget_header span12">トピック一覧</div>
</div>
<hr class="toumei" />
<div id="topicList" style="margin-left: 0px;">
</div>

<div class="row hide" id="topicreadmore">
<a href="<?php echo public_path('communityTopic/listCommunity').'/'.$communityId ?>" class="btn btn-block span11"><?php echo __('More')?></a>
</div>
<?php endif; ?>
