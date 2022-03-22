<div class="wsu-plugin-embed-code">
    <p class="wsu-plugin-embed-code__warning">Any content embedded on WSU websites must meet federally required accessibility standards or be accompanied by the same content in an appropriate accessible format. If you are not certain of the accessibility of the embedded content, please contact the web team at <a rel="noreferrer noopener" target="_blank" href="http://web.wsu.edu/">web.wsu.edu</a>. Embed codes will be audited and user’s option to embed content <strong>will be removed</strong> if users repeatedly post inaccessible content.</p>
    <?php if ( ! empty( $post_id ) ) : ?>
        <h2>Shortcode</h2>
        <code>[embed_code id="<?php echo esc_attr( $post_id ); ?>"]</code>
        <p class="wsu-plugin-embed-code__helper">Past the above shortcode on a page/post to display the embed code. The embed code must be published before it will appear on the page/post.</p>
    <?php endif; ?>
    <hr />
    <h2>Embed Code</h2>
    <textarea class="wsu-plugin-embed-code__code" id="wsuwp_embed_code" name="wsuwp_embed_code"><?php if ( ! empty( $embed_code ) ) : ?><?php echo $embed_code; ?><?php endif; ?></textarea>
</div>
<style>
    .wsu-plugin-embed-code__code {
        width: 100%;
        height: 400px;
    }
    .wsu-plugin-embed-code code {
        background-color: #fff;
        border: 1px solid #2271b1;
        border-radius: 4px;
        padding: 1rem 1.5rem;
        display: inline-block;
        font-size: 18px;
    }
    .wsu-plugin-embed-code h2 {
        padding-left: 0 !important;
        font-size: 20px !important;
        font-weight: 400 !important;
    }
    .wsu-plugin-embed-code hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .wsu-plugin-embed-code__warning {
        font-size: 16px;
        line-height: 1.5;
    }
</style>