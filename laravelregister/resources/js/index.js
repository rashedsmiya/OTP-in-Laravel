function calculateFactorial(inputNumber){

    if(inputNumber < 0){
        throw new Error("Input number must be greater than 0");
    }

    let result = 1;
    for(let i  = 1; i <= inputNumber; i++){
        result = result * i;
    } 
    return result;
}

function calculateFactorialUsingRecursion(inputNumber){
    if(inputNumber < 0){
        throw new Error("Input number must be greater than 0r equal to 0");
    }
    
    if(inputNumber == 0 || inputNumber === 1){
        return 1;
    }
    return inputNumber * calculateFactorialUsingRecursion(inputNumber - 1);
}

// console.log(calculateFactorial(4));
// console.log("3!", calculateFactorial(3));
// console.log("10!", calculateFactorial(10));
// console.log("0!", calculateFactorial(0));
// console.log("-1!", calculateFactorial(1));


console.log("calculateFactorialUsingRecursion");
console.log(calculateFactorialUsingRecursion(4));
console.log("3!", calculateFactorialUsingRecursion(3));
console.log("10!", calculateFactorialUsingRecursion(10));
console.log("0!", calculateFactorialUsingRecursion(0));
console.log("-1!", calculateFactorialUsingRecursion(1));