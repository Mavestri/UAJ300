let submenus = {
    authorMenu: document.getElementById("author-stories"),
    reviewerMenu: document.getElementById("reviewer-stories"),
    editorMenu: document.getElementById("editor-stories"),
    adminMenu: document.getElementById("admin-stories")
}

let embedFrame = document.getElementById("contentEmbed");
let path = document.getElementById("path");

function openSubmenu(menuId) {
    for(var menuName in submenus) {
        if(menuId === menuName && submenus[menuName].style.display != 'block')
            submenus[menuName].style.display = 'block';
        else if(submenus[menuName].style.display === 'block')
            submenus[menuName].style.display = 'none';
    }
}

function openPage(url) {
    embedFrame.src = url;
    path.innerText = url.replace(/\//g, ' > ').replace(/_/g, ' ').replace(/\b[a-z]/g, function(l) { return l.toUpperCase(); }).replace(/.html/gi, '').replace(/.php/gi, '');
    return true;
}
