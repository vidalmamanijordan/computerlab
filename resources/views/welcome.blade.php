<x-app-layout>    
    <div class="main">
        <div class="slider">
            <img id="id1" src="https://tecdn.b-cdn.net/img/Photos/Slides/img%20(15).jpg">
            <div class="btn">
                <button onclick="back()"><i class="fa-solid fa-circle-arrow-left"></i></button>
                <button onclick="next()" class="float-right"><i class="fa-solid fa-circle-arrow-right"></i></button>    
            </div>  
        </div>
    </div>
    <script>
        let mainimg = document.querySelector("#id1");
        let images = ["https://tecdn.b-cdn.net/img/Photos/Slides/img%20(15).jpg",
                    "https://tecdn.b-cdn.net/img/Photos/Slides/img%20(22).jpg",
                    "https://tecdn.b-cdn.net/img/Photos/Slides/img%20(23).jpg"];

        let num = 1;

        function next() {
            num++;
            if (num >= images.length) {
                num = 0;
                mainimg.src = images[num];
            }else{
                mainimg.src = images[num];
            }
        }

        function back() {
            num--;
            if (num<0) {
                num=images.length-1;
                mainimg.src=images[num];
            } else {
                mainimg.src=images[num];
            }
        }

        setInterval(function () {
            let percentage = num * -100;
            mainimg.style.transform = "translateX("+ percentage +"%)";
            num++;
            if (num > images.length}) {
                num = 0;
            }
        }, 1000);
    </script>
</x-app-layout>
