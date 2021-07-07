// @license magnet:?xt=urn:btih:1f739d935676111cfff4b4693e3816e664797050&dn=gpl-3.0.txt GPL-v3-or-Later

var quotes = [
    "Your work is going to fill a large part of your life, and the only way to be truly satisfied is to do what you believe is great work. And the only way to do great work is to love what you do. If you haven’t found it yet, keep looking. Don’t settle. As with all matters of the heart, you’ll know when you find it - Steve Jobs",
    "Have the courage to follow your heart and intuition. They somehow already know what you truly want to become - Steve Jobs",
    "Don’t let the noise of others’ opinions drown out your own inner voice - Steve Jobs",
    "Your time is limited, so don’t waste it living someone else’s life - Steve Jobs",
    "The people who are crazy enough to think they can change the world are the ones who do - Steve Jobs",
    "When you grow up you tend to get told that the world is the way it is and your life is just to live your life inside the world. Try not to bash into the walls too much. Try to have a nice family life, have fun, save a little money. That’s a very limited life. Life can be much broader once you discover one simple fact: Everything around you that you call life was made up by people that were no smarter than you. And you can change it, you can influence it… Once you learn that, you’ll never be the same again - Steve Jobs",

    "Imagination is more important than knowledge. Knowledge is limited. Imagination encircles the world - Albert Einstein",
    "If you can't explain it to a six year old, you don't understand it yourself - Albert Einstein",
    "Life is like riding a bicycle. To keep your balance, you must keep moving - Albert Einstein",

    "Live as if you were to die tomorrow. Learn as if you were to live forever - Mahatma Gandhi",
    "Freedom is not worth having if it does not include the freedom to make mistakes - Mahatma Gandhi",
    "You assist an evil system most effectively by obeying its orders and decrees. An evil system never deserves such allegiance. Allegiance to it means partaking of the evil. A good person will resist an evil system with his or her whole soul - Mahatma Gandhi",

    "Our highest endeavor must be to develop free human beings who are able of themselves to impart purpose and direction to their lives. The need for imagination, a sense of truth, and a feeling of responsibility, these three forces are the very nerve of education - Rudolf Steiner",
    "The main difference in the effectiveness of teaching comes from the thoughts the teacher has had during the entire time of his or her existence and brings into the classroom. A teacher concerned with developing humans affects the students quite differently from a teacher who never thinks about such things - Rudolf Steiner",

    "All our dreams can come true if we have the courage to pursue them - Walt Disney",

    "With software there are only two possibilites: either the users control the programme or the programme controls the users. If the programme controls the users, and the developer controls the programme, then the programme is an instrument of unjust power - Richard Stallman",
    "Free software is software that respects your freedom and the social solidarity of your community. So it's free as in freedom - Richard Stallman",
    "People said I should accept the world. Bullshit! I don't accept the world - Richard Stallman",
    "Proprietary software tends to have malicious features. The point is with a proprietary program, when the users dont have the source code, we can never tell. So you must consider every proprietary program as potential malware - Richard Stallman",

    "A child born today will grow up with no conception of privacy at all. They’ll never know what it means to have a private moment to themselves an unrecorded, unanalysed thought. And that’s a problem because privacy matters, privacy is what allows us to determine who we are and who we want to be - Edward Snowden",
    "Even if you're not doing anything wrong, you are being watched and recorded - Edward Snowden",
    "I don't want to live in a world where everything that I say, everything I do, everyone I talk to, every expression of creativity or love or friendship is recorded - Edward Snowden"
];

var quote = Math.floor(quotes.length * Math.random());
document.write("<h2>" + quotes[quote] + "</h2>");

// @license-end