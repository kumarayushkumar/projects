import React from "react"
import Confetti from "react-confetti"

export default function Rick() {
    const [ten, setTen] = React.useState(false)
    const [ten2, setTen2] = React.useState(false)

    const [message, setmessage] = React.useState(false)
    const [message2, setmessage2] = React.useState(false)
     
    function start() {
        if(!ten) {
            setTen(true)
            setmessage(true)
        }
    }

    function start2() {
        if(!ten2) {
            setTen2(true)
            setmessage2(true)
        }
    }

    return (
        <>
            {ten && <Confetti />}
            {ten2 && <Confetti />}
            <main>
                {message && <p class="temt">Congrats +2 inch pp and 1 millon</p>}
                {message2 && <p class="temt">Hot girl on the way</p>}
                {message && <a class="temt2" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Click here</a>}
                <button onClick={start}>take 1 Million but your pp wil be 2 inch</button>
                <button onClick={start2} className="button2">fall in love with hot girl</button>
            </main>
        </>
    )   
}