<h2><?php p($l->t("We found some existing ownCloud accounts that could belong to you:")); ?></h2>
<div id="accountsWrap">
  <table id="accountsList">
        <tbody>
	<?php foreach($_['accounts'] as $uid => $name): ?>
	<tr>
		<td><?php p($name); ?></td>
		<td class="username">(<em><?php p($uid); ?></em>)</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
  </table>
</div>
<p id="note"><?php p($l->t("If you see your account in this list, please go back and log in with your existing ownCloud account. Otherwise click on continue.")); ?></p>
<form method="post">
<fieldset>
<input type="submit" name="back" id="back" title="<?php p($l->t("Back to login page.")); ?>" class="primary" value="<?php p($l->t('Back')); ?>" />
<input type="submit" name="continue" id="continue" title="<?php p($l->t("Continue with your current identity. New account will be created.")); ?>" class="login primary" value="<?php p($l->t('Continue')); ?>" />
<input type="hidden" name="requesttoken" value="<?php print_unescaped($_['requesttoken']); ?>" id="requesttoken">
</fieldset>
</form>
