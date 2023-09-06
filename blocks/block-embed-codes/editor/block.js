const { registerBlockType } = wp.blocks;

import Edit from "./edit";

registerBlockType("wsuwp/embed-code", {
  title: "WSU Embed Code",
  icon: "menu",
  apiVersion: 2,
  category: "text",
  attributes: {
    embedId: {
      type: "string",
      default: "",
    },
    embedTitle: {
        type: "string",
        default: "",
    },
    url: {
        type: "string",
        default: "",
    },
    isIframe: {
      type: "boolean",
      default: false,
    },
    isIframe: {
        type: "boolean",
        default: false, 
    },
    iframeTitle: {
        type: "string",
        default: "",
    },
    iframeWidth: {
        type: "string",
        default: "100%",
    },
    iframeHeight: {
        type: "string",
        default: "800px",
    },
    wrap: {
        type: "boolean",
        default: false,
    },
    doBlocks: {
      type: "boolean",
      default: false,
  },
    
  },
  edit: Edit,
});