@extends('layouts.content')

@section('content')
    <template id="mct-label">
        <canvas width="@{{ width }}" height="@{{ height }}"></canvas>
    </template>
    <mct-label width="100" text="MILL" color="blue"></mct-label>
@endsection

@section('script')

    <script>
        new Vue({
            el: '#app'
        });

        Vue.component('mct-label', {
            template: '#mct-label',

            props: [
                'width',
                'text',
                'color'
            ],

            data: function(){
                return {
                    colors: {
                        red:      "#E74C3C",
                        orange:   "#F39C12",
                        green:    "#00BC8C",
                        blue:     "#3498DB",
                        darkBlue: "#375A7F",
                        grey:     "#464545"
                    }
                }
            },

            computed: {
                height: function() {
                    return (3 * this.width);
                }
            },

            directives: {
                insertMessage: function(canvasElement, binding) {
                    // Get canvas context
                    var ctx = canvasElement.getContext("2d");

                    // Clear the canvas
                    ctx.clearRect(0, 0, 300, 150);

                    // Insert stuff into canvas
                    ctx.fillStyle = "black";
                    ctx.font = "20px Georgia";
                    ctx.fillText(binding.value, 10, 50);
                }
            }

        });

        /*
        var c = document.getElementById("lCanvas");
        var ctx = c.getContext("2d");

        var red = "#E74C3C";
        var orange = "#F39C12";
        var green = "#00BC8C";
        var blue = "#3498DB";
        var darkBlue = "#375A7F";
        var grey = "#464545";

        var labelText = "BURN";
        var primaryColor = grey;
        var secondaryColor = "white";

        ctx.imageSmoothingEnabled = true;
        ctx.scale(c.width/100,c.height/300);

        ctx.beginPath();
        ctx.arc(50,50,49,Math.PI,2*Math.PI);
        ctx.lineTo(99, 299);
        ctx.lineTo(50, 200);
        ctx.lineTo(  1, 299);
        ctx.closePath();

        ctx.fillStyle = primaryColor;
        ctx.fill();

        ctx.save();
        ctx.translate(7.5, 7.5);
        ctx.scale(0.85, 0.85);
        ctx.beginPath();
        ctx.arc(50,50,49,Math.PI,2*Math.PI);
        ctx.lineTo(99, 299);
        ctx.lineTo(50, 200);
        ctx.lineTo(  1, 299);
        ctx.closePath();

        ctx.lineWidth = "5";
        ctx.strokeStyle = secondaryColor;
        ctx.stroke();
        ctx.restore();

        ctx.fillStyle = secondaryColor;
        ctx.font="65px monospace";

        ctx.save();
        ctx.translate(29, 25);
        ctx.rotate(90*Math.PI/180);
        ctx.fillText(labelText,0,0);
        ctx.restore();
        */
    </script>
@endsection