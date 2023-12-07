const words = ["Programmers", "Problem Solvers", "Technology Driven", "Curious Minded"]; 
let currentIndex = 0;
let charIndex = 0;
let isTyping = true;
const typingSpeed = 100; 
const eraseSpeed = 50;  

const typingText = document.getElementById('typing-text');
const constantText = document.getElementById('constant-text');

function typeWord() {
    if (charIndex < words[currentIndex].length) {
        typingText.textContent += words[currentIndex].charAt(charIndex);
        charIndex++;
        setTimeout(typeWord, typingSpeed);
    } else {
        isTyping = false;
        setTimeout(eraseWord, 1000); 
    }
}

function eraseWord() {
    if (charIndex > 0) {
        typingText.textContent = words[currentIndex].substring(0, charIndex - 1);
        charIndex--;
        setTimeout(eraseWord, eraseSpeed);
    } else {
        isTyping = true;
        currentIndex = (currentIndex + 1) % words.length; 
        setTimeout(typeWord, 750); 
    }
}

function startTyping() {
    if (isTyping) {
        eraseWord();
    } else {
        typeWord();
    }
}

startTyping();
