function isPrime($num) {
    for ($ i = 2; $i < num; $i++) {
        if ($num % $i == 0) return false;
    }
    return num >= 2;
}
 
echo isPrime(20);
echo isPrime(25)