import React, { useState, useEffect } from "@wordpress/element";
import apiFetch from "@wordpress/api-fetch";
import { InnerBlocks, InspectorControls, useBlockProps, InspectorAdvancedControls, } from "@wordpress/block-editor";
import {
  TextControl,
  SelectControl,
  BaseControl,
  ToggleControl,
  PanelBody,
} from "@wordpress/components";

import "./_style.scss";

const edit = (props) => {
  const { className, attributes, setAttributes } = props;
  const blockProps = useBlockProps({
    className: "wsu-embed-code",
    style: {},
  });
  const [embedCodes, setEmbedCodes] = useState([]);

  useEffect(() => {
    apiFetch({ path: "/wp/v2/wsuwp_embed_code/?per_page=50" }).then((response) => {

        const embedCodes = response;

        if ( embedCodes ) {
            const options = embedCodes.map( ( embedCode ) => {
            return { label: embedCode.title.rendered, value: embedCode.id, url: embedCode.link };
        });

        options.push( { label: 'None', value: '' } )

        setEmbedCodes( options );
      }
    });
  }, []);


  const setEmbedAttributes = ( embedId ) => {

    let embedCode = false;

    if ( embedCodes ) {

        embedCodes.forEach( ( embed ) => { if ( embedId == embed.value ) { embedCode = embed } } )

    }

    if ( embedCode ) {

        setAttributes( { embedId } );

        setAttributes( { embedTitle: embedCode.label } );

        setAttributes( { url: embedCode.url } );

    }

  }

  console.log( wp.data.select( 'core' ).getSite() )

  return (
    <>
      <InspectorControls>
        <PanelBody title="General" initialOpen={true}>
            <SelectControl
                label="Embed Code to Display"
                value={ attributes.embedId }
                options={ embedCodes }
                onChange={ ( embedId ) => setEmbedAttributes( embedId )}
            />
           { ! attributes.isIframe && <ToggleControl
                label='Wrap Embed Code'
                checked={ ( attributes.wrap ) }
                onChange={ ( wrap ) => setAttributes( { wrap } )  }
                help={ 'Adds a div wrapper with additional classes to embed code'}
            /> }
            { ! attributes.wrap && <ToggleControl
                label='Iframe Embed Code'
                checked={ ( attributes.isIframe ) }
                onChange={ ( isIframe ) => setAttributes( { isIframe } )  }
                help={ 'Display embed code in Iframe'}
            /> }
            { attributes.isIframe && <>
                <TextControl
                    label="Iframe Title"
                    value={ attributes.iframeTitle }
                    onChange= { ( Title ) => setAttributes( { Title } ) }
                    help='All Iframes must have a title attribute'
                />
                <TextControl
                    label="Iframe Width"
                    value={ attributes.iframeWidth }
                    onChange= { ( iframeWidth ) => setAttributes( { iframeWidth } ) }
                />
                <TextControl
                    label="Iframe Height"
                    value={ attributes.iframeHeight }
                    onChange= { ( iframeHeight ) => setAttributes( { iframeHeight } ) }
                />
            </>
            }
        </PanelBody>
      </InspectorControls>
      <InspectorAdvancedControls>
        
	</InspectorAdvancedControls>
      <div {...blockProps}>
      { attributes.embedId && <><div className="wsu-embed-code-block__selected">
            <div className="wsu-embed-code-block__heading">Embed Code</div>
            <div className="wsu-embed-code-block__title">: { attributes.embedTitle }</div>
        </div>
        </>
      }
        { ! attributes.embedId && <SelectControl
            label="Select Embed Code"
            value={ attributes.embedId }
            options={ embedCodes }
            onChange={ ( embedId ) => setEmbedAttributes( embedId )}
          />
        }
      </div>
    </>
  );
};

export default edit;
