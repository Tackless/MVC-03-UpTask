!function(){!async function(){try{const a="/api/tareas?id="+r(),n=await fetch(a),o=await n.json();e=o.tareas,t()}catch(e){console.log(e)}}();let e=[];function t(){if(function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),0===e.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No hay Tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const n={0:"Pendiente",1:"Completa"};e.forEach(c=>{const i=document.createElement("LI");i.dataset.tareaId=c.id,i.classList.add("tarea");const s=document.createElement("P");s.textContent=c.nombre,s.ondblclick=function(){a(editar=!0,{...c})};const d=document.createElement("DIV");d.classList.add("opciones");const l=document.createElement("BUTTON");l.classList.add("estado-tarea"),l.classList.add(""+n[c.estado].toLowerCase()),l.textContent=n[c.estado],l.dataset.estadoTarea=c.estado,l.ondblclick=function(){!function(e){const t="1"===e.estado?"0":"1";e.estado=t,o(e)}({...c})};const m=document.createElement("BUTTON");m.classList.add("eliminar-tarea"),m.dataset.idTarea=c.id,m.textContent="Elminar",m.ondblclick=function(){!function(a){Swal.fire({title:"¿Eliminar Tarea?",showCancelButton:!0,confirmButtonText:"Sí",cancelButtonText:"No"}).then(n=>{n.isConfirmed&&async function(a){const{estado:n,id:o,nombre:c}=a,i=new FormData;i.append("id",o),i.append("nombre",c),i.append("estado",n),i.append("proyectoId",r());try{const n="http://localhost:3001/api/tareas/eliminar",o=await fetch(n,{method:"POST",body:i}),r=await o.json();r.resultado&&(Swal.fire("Eliminado!",r.mensaje,"success"),e=e.filter(e=>e.id!==a.id),t())}catch(e){console.log(e)}}(a)})}(c)},d.appendChild(l),d.appendChild(m),i.appendChild(s),i.appendChild(d);document.querySelector("#listado-tareas").appendChild(i)})}function a(a=!1,c={}){const i=document.createElement("DIV");i.classList.add("modal"),i.innerHTML=`\n        <form class="formulario nueva-tarea">\n            <legend>${a?"Editar Tarea":"Añade una nueva tarea"}</legend>\n            <div class="campo">\n                <label for="tarea">Tarea</label>\n                <input type="text" name="tarea" id="tarea" placeholder="${c.nombre?"Editar la Tarea":"Añadir Tarea al Proyecto Actual"}" value="${c.nombre?c.nombre:""}">\n            </div>\n            <div class="opciones">\n                <input type="submit" value="${a?"Guardar Cambios":"Añadir tarea"}" class="submit-nueva-tarea">\n                <button type="button" class="cerrar-modal">Cancelar</button>\n            </div>\n        </form>\n        `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),i.addEventListener("click",(function(s){if(s.preventDefault(),s.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{i.remove()},500)}if(s.target.classList.contains("submit-nueva-tarea")){const i=document.querySelector("#tarea").value.trim();if(""===i)return void n("El Nombre de la Tarea es Obligatorio","error",document.querySelector(".formulario legend"));a?(c.nombre=i,o(c)):async function(a){const o=new FormData;o.append("nombre",a),o.append("proyectoId",r());try{const r="http://localhost:3001/api/tareas",c=await fetch(r,{method:"POST",body:o}),i=await c.json();if(i.mensaje&&n(i.mensaje,i.tipo,document.querySelector(".formulario legend")),"exito"===i.tipo){const n=document.querySelector(".modal");setTimeout(()=>{n.remove()},3e3);const o={id:String(i.id),nombre:a,estado:"0",proyectoId:i.proyectoId};e=[...e,o],t()}}catch(e){console.log(e)}}(i)}})),document.querySelector(".dashboard").appendChild(i)}function n(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},5e3)}async function o(e){console.log(e)}function r(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelector("#agregar-tarea").addEventListener("click",(function(){a()}))}();