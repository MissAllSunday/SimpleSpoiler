
(function(currentWindow, currentDocument, simpleSpoilerShow, simpleSpoilerHide) {
    let spoilerToggleClass = 'spoiler_toggle',
        spoilerBlock = currentDocument.getElementsByClassName(spoilerToggleClass),
        innerBlock = currentDocument.getElementsByClassName('inner'),
        textShow = '[' + (simpleSpoilerShow || 'Show') + ']',
        textHide = '[' + (simpleSpoilerHide || 'Hide') + ']';

    if (!spoilerBlock)
        return;

    function toggleSpoiler(currentSpoilerElement) {
        let anchorToggle = currentDocument.createElement('a'),
            parentSpoilerElement = currentSpoilerElement.parentNode;

        currentSpoilerElement.style.display = "none";
        anchorToggle.className = 'spoiler_toggle_link';
        anchorToggle.href = '#' + currentSpoilerElement.id;
        anchorToggle.innerHTML = textShow;

        anchorToggle.onclick = function() {

            let isCollapsed = currentSpoilerElement.style.display === "none";

            currentSpoilerElement.style.display = isCollapsed ? "block" : "none";

            if (isCollapsed)
                currentSpoilerElement.classList.add('simpleSpoilerFadeIn');

            else
                currentSpoilerElement.classList.remove('simpleSpoilerFadeIn');

            this.innerHTML = isCollapsed ? textHide : textShow;
        };

        parentSpoilerElement.insertBefore(anchorToggle, currentSpoilerElement);
    }

    for (let index = 0, len = spoilerBlock.length; index < len; ++index) {
        spoilerBlock[index].id = 'simple_spoiler_' + index;
        toggleSpoiler(spoilerBlock[index]);
    }

    let mutationObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            for (let index = 0, len = mutation.addedNodes.length; index < len; ++index) {
                let currentNode = mutation.addedNodes[index];

                if (currentNode.className === spoilerToggleClass) {
                    currentNode.id = 'd_simple_spoiler_' + index;
                    toggleSpoiler(currentNode);
                }
            }
        });
    });

    for (let i = 0, len = innerBlock.length; i < len; ++i) {
        let currentBlock = innerBlock[i],
            spoilerCollection = currentBlock.getElementsByClassName(spoilerToggleClass);

        if (spoilerCollection.length > 0)
            mutationObserver.observe(currentBlock, {
                attributes: false,
                characterData: false,
                childList: true,
                subtree: true,
                attributeOldValue: false,
                characterDataOldValue: false
            });
    }
})(window, document, simpleSpoilerShow, simpleSpoilerHide);