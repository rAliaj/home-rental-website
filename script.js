            const btnRegjistrim=document.getElementById("regjistrim");
            const kycu=document.getElementById("kycu");
            const regjistrohu=document.getElementById("regjistrohu");
            btnRegjistrim.addEventListener('click',function(){
                if(kycu.style.opacity=='0'){
                    kycu.style.opacity='1';
                    kycu.style.pointerEvents='auto';
                    btnRegjistrim.innerHTML="Regjistrohu";
                    regjistrohu.style.opacity='0';
                    regjistrohu.style.pointerEvents='none';
                }else{
                    kycu.style.opacity='0';
                    kycu.style.pointerEvents='none';
                    regjistrohu.style.opacity='1';
                    regjistrohu.style.pointerEvents='auto';
                    btnRegjistrim.innerHTML="Hyr";
                }
            });