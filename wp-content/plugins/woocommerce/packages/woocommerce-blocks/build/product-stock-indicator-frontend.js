(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[76],{116:function(t,o,n){"use strict";n.d(o,"a",(function(){return c})),n(51);var e=n(36);const c=()=>e.m>1},117:function(t,o,n){"use strict";n.d(o,"a",(function(){return r}));var e=n(24),c=n(19);const r=t=>Object(e.a)(t)?JSON.parse(t)||{}:Object(c.a)(t)?t:{}},19:function(t,o,n){"use strict";n.d(o,"a",(function(){return e})),n.d(o,"b",(function(){return c}));const e=t=>!(t=>null===t)(t)&&t instanceof Object&&t.constructor===Object;function c(t,o){return e(t)&&o in t}},288:function(t,o,n){"use strict";n.d(o,"a",(function(){return i}));var e=n(63),c=n(116),r=n(19),s=n(117);const i=t=>{if(!Object(c.a)())return{className:"",style:{}};const o=Object(r.a)(t)?t:{},n=Object(s.a)(o.style);return Object(e.__experimentalUseColorProps)({...o,style:n})}},294:function(t,o,n){"use strict";n.d(o,"a",(function(){return r}));var e=n(19),c=n(117);const r=t=>{const o=Object(e.a)(t)?t:{},n=Object(c.a)(o.style),r=Object(e.a)(n.typography)?n.typography:{};return{style:{fontSize:o.fontSize?`var(--wp--preset--font-size--${o.fontSize})`:r.fontSize,lineHeight:r.lineHeight,fontWeight:r.fontWeight,fontStyle:r.fontStyle,textTransform:r.textTransform,fontFamily:o.fontFamily}}}},392:function(t,o){},436:function(t,o,n){"use strict";n.r(o),n.d(o,"Block",(function(){return f}));var e=n(0),c=n(1),r=n(5),s=n.n(r),i=n(50),a=n(288),u=n(294),l=n(140);n(392);const f=t=>{const{className:o}=t,{parentClassName:n}=Object(i.useInnerBlockLayoutContext)(),{product:r}=Object(i.useProductDataContext)(),l=Object(a.a)(t),f=Object(u.a)(t);if(!r.id||!r.is_purchasable)return null;const b=!!r.is_in_stock,p=r.low_stock_remaining,d=r.is_on_backorder;return Object(e.createElement)("div",{className:s()(o,l.className,"wc-block-components-product-stock-indicator",{[n+"__stock-indicator"]:n,"wc-block-components-product-stock-indicator--in-stock":b,"wc-block-components-product-stock-indicator--out-of-stock":!b,"wc-block-components-product-stock-indicator--low-stock":!!p,"wc-block-components-product-stock-indicator--available-on-backorder":!!d}),style:{...l.style,...f.style}},p?(t=>Object(c.sprintf)(
/* translators: %d stock amount (number of items in stock for product) */
Object(c.__)("%d left in stock","woocommerce"),t))(p):((t,o)=>o?Object(c.__)("Available on backorder","woocommerce"):t?Object(c.__)("In Stock","woocommerce"):Object(c.__)("Out of Stock","woocommerce"))(b,d))};o.default=Object(l.withProductDataContext)(f)},5:function(t,o,n){var e;!function(){"use strict";var n={}.hasOwnProperty;function c(){for(var t=[],o=0;o<arguments.length;o++){var e=arguments[o];if(e){var r=typeof e;if("string"===r||"number"===r)t.push(e);else if(Array.isArray(e)){if(e.length){var s=c.apply(null,e);s&&t.push(s)}}else if("object"===r)if(e.toString===Object.prototype.toString)for(var i in e)n.call(e,i)&&e[i]&&t.push(i);else t.push(e.toString())}}return t.join(" ")}t.exports?(c.default=c,t.exports=c):void 0===(e=function(){return c}.apply(o,[]))||(t.exports=e)}()}}]);