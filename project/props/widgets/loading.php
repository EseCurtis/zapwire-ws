<div class="__loading">
    <div class="__loading-object">
        <div class="__loading-ring">

        </div>
    </div>
</div>

<style>
    .__loading {
        position: fixed;
        z-index: 999;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        backdrop-filter: blur(2px);
        background: #00000061;
        display: none;
        align-items: center;
        justify-content: center;
        opacity: 0;
    }

    .__loading-object{
        width: 70px;
        height: 70px;
        padding: 1em;
        background: #fff;
        border-radius: 10px;
    }

    .__loading-ring {
        widht: 100%;
        height: 100%;
        border: 3px solid blue;
        border-left-color: transparent;
        border-radius: 100%;
        animation: rotate 1s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    const __loader = {
        start: () => {
            let el = document.querySelector('.__loading')

            el.style.display = 'flex'
            el.style.opacity = '1'
        },
        
        stop: () => {
            let el = document.querySelector('.__loading')

            setTimeout(() => {
                el.style.display = 'none'
            }, 2000)
            el.style.opacity = '1'
        }
    }

    loader = __loader
</script>