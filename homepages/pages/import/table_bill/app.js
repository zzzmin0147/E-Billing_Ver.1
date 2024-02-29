const chkbxAll = document.querySelector("#chkbxAll");
const chkbxOptions = document.querySelectorAll(".select-option");

function selectAllChkoxes(){
    const isChecked=chkbxAll.checked;
    for (let i=0;i<chkbxOptions.length;i++){
        chkbxOptions[i].checked = isChecked;
    }
}

chkbxAll.addEventListener("change",()=>{
    Array.from(chkbxOptions).map((chkbx)=>{
        chkbx.checked = chkbxAll.checked;
    })
})