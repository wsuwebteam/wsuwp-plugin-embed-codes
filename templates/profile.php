<h3 style="margin-top:2rem">Embed Code Access</h3>
<table class="form-table">
	<tr>
		<th scope="row">
			Embed Code
		</th>
		<td>
			<input type="checkbox" name="wsuwp_allow_embed_code" id="wsuwp_allow_embed_code" class="checkbox" <?php if ( ! empty( get_the_author_meta( '_wsuwp_allow_embed_code', $user->ID ) ) ) { echo 'checked'; } ?> value="1" /><label for="wsuwp_allow_embed_code">Enable Access</label>
		</td>
	</tr>
</table>
