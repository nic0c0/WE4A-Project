function getHeaderHeight() {
    const header = document.querySelector('header');
    const headerHeight = window.getComputedStyle(header).height;
    return headerHeight;
  }
  
  function setSiblingHeight() {
    const headerHeight = getHeaderHeight();
    const sibling = document.querySelector('header + *');
    sibling.style.top = `${headerHeight}`;
    sibling.style.position = 'relative';
    sibling.style.marginBottom = `${headerHeight}`;
    console.log(sibling);
  }
  