function cuteAlert({type:e,title:t,message:r,buttonText:s="OK",confirmText:a="OK",cancelText:l="Cancel",closeStyle:c}){return new Promise(n=>{setInterval(()=>{},5e3);let o=document.querySelector("body"),i=document.getElementsByTagName("script"),d="";for(let u of i)u.src.includes("cute-alert.js")&&(d=u);let v=d.src;v=v.substring(0,v.lastIndexOf("/"));let m="alert-close";"circle"===c&&(m="alert-close-circle");let b=`
    <button class="alert-button ${e}-bg ${e}-btn">${s}</button>
    `;"question"===e&&(b=`
      <div class="question-buttons">
        <button class="confirm-button ${e}-bg ${e}-btn">${a}</button>
        <button class="cancel-button error-bg error-btn">${l}</button>
      </div>
      `);let g=`
    <div class="alert-wrapper">
      <div class="alert-frame">
        <div class="alert-header ${e}-bg">
          <span class="${m}">X</span>
          <img class="alert-img" src="${v}/img/${e}.svg" />
        </div>
        <div class="alert-body">
          <span class="alert-title">${t}</span>
          <span class="alert-message">${r}</span>
          ${b}
        </div>
      </div>
    </div>
    `;o.insertAdjacentHTML("afterend",g);let y=document.querySelector(".alert-wrapper"),f=document.querySelector(".alert-frame"),p=document.querySelector(`.${m}`);if("question"===e){let q=document.querySelector(".confirm-button"),S=document.querySelector(".cancel-button");q.addEventListener("click",()=>{y.remove(),n("confirm")}),S.addEventListener("click",()=>{y.remove(),n()})}else{let E=document.querySelector(".alert-button");E.addEventListener("click",()=>{y.remove(),n()})}p.addEventListener("click",()=>{y.remove(),n()}),y.addEventListener("click",()=>{y.remove(),n()}),f.addEventListener("click",e=>{e.stopPropagation()})})}function cuteToast({type:e,message:t,timer:r=5e3}){return new Promise(s=>{document.querySelector(".toast-container")&&document.querySelector(".toast-container").remove();let a=document.querySelector("body"),l=document.getElementsByTagName("script"),c="";for(let n of l)n.src.includes("cute-alert.js")&&(c=n);let o=c.src;o=o.substring(0,o.lastIndexOf("/"));let i=`
    <div class="toast-container ${e}-bg">
      <div>
        <div class="toast-frame">
          <img class="toast-img" src="${o}/img/${e}.svg" />
          <span class="toast-message">${t}</span>
          <div class="toast-close">X</div>
        </div>
        <div class="toast-timer ${e}-timer" style="animation: timer ${r}ms linear;"/>
      </div>
    </div>
    `;a.insertAdjacentHTML("afterend",i);let d=document.querySelector(".toast-container");setTimeout(()=>{d.remove(),s()},r);let u=document.querySelector(".toast-close");u.addEventListener("click",()=>{d.remove(),s()})})}