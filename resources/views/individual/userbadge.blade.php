@extends('layouts.app')

@section('content')


 {!! $data->farmer() !!}
<div id="demo"></div>
<img id="barcode"/>
<h1><b><center>This is a test page for printing</center></b><hr color=#00cc00 width=95%></h1>
        <b>Div 1:</b> <a href="javascript:printDiv('div1')">Print</a><br>
        <div id="div1">
            <canvas id="myCanvas" width="990" height="615" style="width:743px;height:462px;"></canvas>
        </div>
        <br><br>
        <b>Div 2:</b> <a href="javascript:printDiv('div2')">Print</a><br>
        <div id="div2">This is the div2's print output</div>
        <br><br>
        <b>Div 3:</b> <a href="javascript:printDiv('div3')">Print</a><br>
        <div id="div3">This is the div3's print output</div>
        <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>


   <button onclick="myFunction()">Print this page</button>
   <button id="btnPrint">Print this other page</button>
    
    @endsection
    @section('scripts')

    <script type="text/javascript">


        $(document).on("click", "#btnPrint", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#div1").printThis({
            debug: false, // show the iframe for debugging
            importCSS: true, // import page CSS
            importStyle: true, // import style tags
            printContainer: true, // grab outer container as well as the contents of the selector
            loadCSS: "", // path to additional css file - us an array [] for multiple
            pageTitle: "", // add title to print page
            removeInline: false, // remove all inline styles from print elements
            printDelay: 1000, // variable print delay; depending on complexity a higher value may be necessary
            header: null, // prefix to html
            formValues: true // preserve input/form values
        });

    });
/*--------------------------------------------------------------------------------------------------------------------------*/
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML= document.getElementById(divId).innerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }

/*--------------------------------------------------------------------------------------------------------------------------*/        
            $(document).ready(function(){
$("#barcode").JsBarcode("54321234",{
width:2,
height:50,
quite: 10,
format:"CODE39",
backgroundColor:"#fff",
lineColor:"#000"
});

        });
/*--------------------------------------------------------------------------------------------------------------------------*/
        $( document ).ready(function() {
   $("#demo").barcode(
"1234567890128", // Value barcode (dependent on the type of barcode)
"code39",{output:'css',bgColor: '#FFFFFF',color: '#000000', barWidth: '1',barHeight: '20',moduleSize: '5', posX: 0,posY: 0,addQuietZone: '1'}
); 
});
/*--------------------------------------------------------------------------------------------------------------------------*/        
        function myFunction() {
            window.print();

}
/*--------------------------------------------------------------------------------------------------------------------------*/
       function wrapText(context, text, x, y, maxWidth, lineHeight) {
        var words = text.split(' ');
        var line = '';

        for(var n = 0; n < words.length; n++) {
          var testLine = line + words[n] + ' ';
          var metrics = context.measureText(testLine);
          var testWidth = metrics.width;
          if (testWidth > maxWidth && n > 0) {
            context.fillText(line, x, y);
            line = words[n] + ' ';
            y += lineHeight;
          }
          else {
            line = testLine;
          }
        }
        context.fillText(line, x, y);
      }

        var canvas = document.getElementById('myCanvas');
        var context = canvas.getContext('2d');
        var headertxt = canvas.getContext('2d');
        var imageObj = new Image();
        var imageBarCode = new Image();
        var x = 350;
        var y = 50;
        var width = 270;
        var height = 265;
        var addr = {!! json_encode($data->home()->address) !!};
        var value = {!! $data->farmer()->registration_num !!};
        
        var btype = 'code39';
        var renderer = 'bmp';
      //var imj = =$('#app_id').value();
      var settings = {
          output:renderer,
          bgColor: '#FFFFFF',
          color: '#000000',
          barWidth: '1',
          barHeight: '20',
          moduleSize: '5',
          posX: 0,
          posY: 0,
          addQuietZone: '1'
        };

      imageObj.onload = function() {
        context.drawImage(imageObj, 50, 30, width-18, height+10);
    };
    imageObj.src = {!! json_encode($data->avatar) !!};


    

        context.beginPath();
        context.rect(0, 0, 900, 600);
        context.fillStyle = "green";
        context.fill();


        
        context.font = '20pt Calibri';




          // textAlign aligns text horizontally relative to placement
          context.textAlign = 'middle';
          // textBaseline aligns text vertically relative to font style
          context.textBaseline = 'middle';
          context.fillStyle = 'black';
          context.fillText('Republic of Trinidad and Tobago', x, y);
          context.font = '30pt Calibri';
          
          context.fillText('Farmer Registration Card', x, y+50);
          context.textAlign = 'left';
          
          context.fillText('Farmer Name: '+{!! json_encode($data->name) !!}, x, y+100);
          //context.fillText('Address: '+{!! json_encode($data->home()->address) !!}, x, y+100);
          context.font = '20pt Calibri';
          wrapText(context,addr,x, y+150,300,30);
          context.font = '30pt Calibri';
          context.fillText('Farmer Type: '+{!! json_encode($farmertype) !!}, x-325, y+275);
          context.fillText('Issue Date: '+ {!! json_encode($data->farmer()->badge()->date_issued) !!}, x-325, y+325);
          context.fillText('Expiry Date: '+ {!! json_encode($data->farmer()->badge()->expiry_date) !!}, x+50, y+325);
          //context.fillText('Farmer Badge: '+{!! $data->farmer()->registration_num !!}, x-350, y+375);
           $(document).ready(function(){
         
          

            imageBarCode.onload = function() {
            context.drawImage(imageBarCode,  x-150, y+450, width+120, height-200);
            };
            imageBarCode.src = $("#barcode").attr("src");
            });

          

/*--------------------------------------------------------------------------------------------------------------------------*/

          (function($) {

    function appendContent($el, content) {
        if (!content) return;

        // Simple test for a jQuery element
        $el.append(content.jquery ? content.clone() : content);
    }

    function appendBody($body, $element, opt) {
        // Clone for safety and convenience
        // Calls clone(withDataAndEvents = true) to copy form values.
        var $content = $element.clone(opt.formValues);

        if (opt.formValues) {
            // Copy original select and textarea values to their cloned counterpart
            // Makes up for inability to clone select and textarea values with clone(true)
            copyValues($element, $content, 'select, textarea');
        }

        if (opt.removeScripts) {
            $content.find('script').remove();
        }

        if (opt.printContainer) {
            // grab $.selector as container
            $content.appendTo($body);
        } else {
            // otherwise just print interior elements of container
            $content.each(function() {
                $(this).children().appendTo($body)
            });
        }
    }

    // Copies values from origin to clone for passed in elementSelector
    function copyValues(origin, clone, elementSelector) {
        var $originalElements = origin.find(elementSelector);

        clone.find(elementSelector).each(function(index, item) {
            $(item).val($originalElements.eq(index).val());
        });
    }

    var opt;
    $.fn.printThis = function(options) {
        opt = $.extend({}, $.fn.printThis.defaults, options);
        var $element = this instanceof jQuery ? this : $(this);

        var strFrameName = "printThis-" + (new Date()).getTime();

        if (window.location.hostname !== document.domain && navigator.userAgent.match(/msie/i)) {
            // Ugly IE hacks due to IE not inheriting document.domain from parent
            // checks if document.domain is set by comparing the host name against document.domain
            var iframeSrc = "javascript:document.write(\"<head><script>document.domain=\\\"" + document.domain + "\\\";</s" + "cript></head><body></body>\")";
            var printI = document.createElement('iframe');
            printI.name = "printIframe";
            printI.id = strFrameName;
            printI.className = "MSIE";
            document.body.appendChild(printI);
            printI.src = iframeSrc;

        } else {
            // other browsers inherit document.domain, and IE works if document.domain is not explicitly set
            var $frame = $("<iframe id='" + strFrameName + "' name='printIframe' />");
            $frame.appendTo("body");
        }

        var $iframe = $("#" + strFrameName);

        // show frame if in debug mode
        if (!opt.debug) $iframe.css({
            position: "absolute",
            width: "0px",
            height: "0px",
            left: "-600px",
            top: "-600px"
        });

        // $iframe.ready() and $iframe.load were inconsistent between browsers
        setTimeout(function() {

            // Add doctype to fix the style difference between printing and render
            function setDocType($iframe, doctype){
                var win, doc;
                win = $iframe.get(0);
                win = win.contentWindow || win.contentDocument || win;
                doc = win.document || win.contentDocument || win;
                doc.open();
                doc.write(doctype);
                doc.close();
            }

            if (opt.doctypeString){
                setDocType($iframe, opt.doctypeString);
            }

            var $doc = $iframe.contents(),
                $head = $doc.find("head"),
                $body = $doc.find("body"),
                $base = $('base'),
                baseURL;

            // add base tag to ensure elements use the parent domain
            if (opt.base === true && $base.length > 0) {
                // take the base tag from the original page
                baseURL = $base.attr('href');
            } else if (typeof opt.base === 'string') {
                // An exact base string is provided
                baseURL = opt.base;
            } else {
                // Use the page URL as the base
                baseURL = document.location.protocol + '//' + document.location.host;
            }

            $head.append('<base href="' + baseURL + '">');

            // import page stylesheets
            if (opt.importCSS) $("link[rel=stylesheet]").each(function() {
                var href = $(this).attr("href");
                if (href) {
                    var media = $(this).attr("media") || "all";
                    $head.append("<link type='text/css' rel='stylesheet' href='" + href + "' media='" + media + "'>");
                }
            });

            // import style tags
            if (opt.importStyle) $("style").each(function() {
                $head.append(this.outerHTML);
            });

            // add title of the page
            if (opt.pageTitle) $head.append("<title>" + opt.pageTitle + "</title>");

            // import additional stylesheet(s)
            if (opt.loadCSS) {
                if ($.isArray(opt.loadCSS)) {
                    jQuery.each(opt.loadCSS, function(index, value) {
                        $head.append("<link type='text/css' rel='stylesheet' href='" + this + "'>");
                    });
                } else {
                    $head.append("<link type='text/css' rel='stylesheet' href='" + opt.loadCSS + "'>");
                }
            }

            // copy 'root' tag classes
            var tag = opt.copyTagClasses;
            if (tag) {
                tag = tag === true ? 'bh' : tag;
                if (tag.indexOf('b') !== -1) {
                    $body.addClass($('body')[0].className);
                }
                if (tag.indexOf('h') !== -1) {
                    $doc.find('html').addClass($('html')[0].className);
                }
            }

            // print header
            appendContent($body, opt.header);

            if (opt.canvas) {
                // add canvas data-ids for easy access after cloning.
                var canvasId = 0;
                // .addBack('canvas') adds the top-level element if it is a canvas.
                $element.find('canvas').addBack('canvas').each(function(){
                    $(this).attr('data-printthis', canvasId++);
                });
            }

            appendBody($body, $element, opt);

            if (opt.canvas) {
                // Re-draw new canvases by referencing the originals
                $body.find('canvas').each(function(){
                    var cid = $(this).data('printthis'),
                        $src = $('[data-printthis="' + cid + '"]');

                    this.getContext('2d').drawImage($src[0], 0, 0);

                    // Remove the markup from the original
                    $src.removeData('printthis');
                });
            }

            // remove inline styles
            if (opt.removeInline) {
                // $.removeAttr available jQuery 1.7+
                if ($.isFunction($.removeAttr)) {
                    $doc.find("body *").removeAttr("style");
                } else {
                    $doc.find("body *").attr("style", "");
                }
            }

            // print "footer"
            appendContent($body, opt.footer);

            setTimeout(function() {
                if ($iframe.hasClass("MSIE")) {
                    // check if the iframe was created with the ugly hack
                    // and perform another ugly hack out of neccessity
                    window.frames["printIframe"].focus();
                    $head.append("<script>  window.print(); </s" + "cript>");
                } else {
                    // proper method
                    if (document.queryCommandSupported("print")) {
                        $iframe[0].contentWindow.document.execCommand("print", false, null);
                    } else {
                        $iframe[0].contentWindow.focus();
                        $iframe[0].contentWindow.print();
                    }
                }

                // remove iframe after print
                if (!opt.debug) {
                    setTimeout(function() {
                        $iframe.remove();
                    }, 1000);
                }

            }, opt.printDelay);

        }, 333);

    };

    // defaults
    $.fn.printThis.defaults = {
        debug: false,           // show the iframe for debugging
        importCSS: true,        // import parent page css
        importStyle: false,     // import style tags
        printContainer: true,   // print outer container/$.selector
        loadCSS: "",            // load an additional css file - load multiple stylesheets with an array []
        pageTitle: "",          // add title to print page
        removeInline: false,    // remove all inline styles
        printDelay: 333,        // variable print delay
        header: null,           // prefix to html
        footer: null,           // postfix to html
        formValues: true,       // preserve input/form values
        canvas: false,          // copy canvas content (experimental)
        base: false,            // preserve the BASE tag, or accept a string for the URL
        doctypeString: '<!DOCTYPE html>', // html doctype
        removeScripts: false,   // remove script tags before appending
        copyTagClasses: false   // copy classes from the html & body tag
    };
})(jQuery);

      
</script>
@endsection
 