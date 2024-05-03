
; You may customize this and other start-up templates; 
; The location of this template is c:\emu8086\inc\0_com_template.txt

org 100h    


jmp etq1: 

gen db "************** Ce programme lit et ecrit seulement les entiers *************** $"


errorm db  0dh,0ah,0ah," Une erreur est survenue. Veuillez verifier votre saisie.$"


 menu db 0dh,0ah,0ah,"**Entrez le type d'operation :**", 0dh, 0ah,0ah,0ah, "$"
    menu1 db " Somme : +  Soustraction : -  Multiplication : *  Division : /", 0dh, 0ah,0ah,0ah, "$"
    menu2 db " Factorielle : !  Puissance : ^  Arrangement : a  Combinaisant : c  PGCD : G", 0dh, 0ah,0ah,0ah, "operation est:$"

Alerte db  0Dh,0Ah ,0ah,'Merci de choisir un nombre enre 0 et 9... ', 0Dh,0Ah, '$'  

 opperr1 db 0Dh, 0Ah,0ah, 'Entrez la premiere operande : $'
 
    opperr2 db 0Dh, 0Ah,0ah, 'Entrez la deuxieme operande : $'
    
    res db 0Dh, 0Ah,0ah,0ah, 'Resultat : $' 
    
    puissance db 0Dh, 0Ah,0ah, 'Entrez la puissance : $' 
    
     continue_msg db 0Dh, 0Ah,0ah, 'Pour continuer, tapez "o". Pour quitter, tapez "q" : $'

opf db 1

p db 1

oper1 db 1 


oper2 db 2


operation db '*' ;;initialisation

 aide db 1
 aide2 db 1 
 opf1 db 1
 opf2 db 1
 oper22 db 1
 oper11 db 1


etq1: 
mov dx, offset gen
mov ah, 09h     
int 21h 
etq:

  
mov ax,0
mov bx,0
mov cx,0
mov dx,0



mov dx, offset menu
mov ah, 09h     
int 21h  
mov dx, offset menu1
mov ah, 09h     
int 21h
mov dx, offset menu2
mov ah, 09h     
int 21h



mov ah,1   
int 21h ; le saisie est dans al = l'operation=*  

cmp al,'('
jne n1
call error
jmp etq
n1:
cmp al,','
jne n2    
call error
jmp etq
n2: 
cmp al,'.'
jne n3    
call error
jmp etq
n3: 
 
cmp al,27h
jne n4    
call error
jmp etq

n4:  

cmp al,'('
jne n5    
call error
jmp etq
n5: 
 

cmp al,'!'  
jne next
mov al,'('
next:
cmp al,'^'
jne next1 
mov al,')'
next1:        
cmp al,'a'
jne next2 
mov al,',' 
next2:        
cmp al,'c'
jne next3 
mov al,'.' 
next3:        
cmp al,'G'
jne next4 
mov al,27h  

next4:


cmp al,27h ;;;verification de bonne operation   

jnl tonext
call error
jmp etq
tonext:
cmp al,'/'  
jng toonext
call error
jmp etq

toonext: 


 
cmp al,'(' 
jne pp

call facto  
call affichage
jmp fin

pp:
cmp al,')'
jne a 
cmp al,')'
jmp pow
        
a: 
cmp al,','
jne c 
 
call arr
call affichage 
jmp fin
 
c:         

cmp al,'.' 
jne pgc  
cmp al,'.'
je com
        
pgc:
cmp al,27h
jne s
cmp al,27h 
je pgcd

s:
cmp al,'+'
jne so  
cmp al,'+'
je som

so: 
cmp al,'-' 
jne m   
cmp al,'-' 
je sous

m:
cmp al,'*'
jne d    
cmp al,'*'
je mull

d:
cmp al,'/'

je divv 


 ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;calcul factoriel;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
facto proc 

cmp dx,0fffh
je calculfacto    
    
 mov dx, offset opperr1
mov ah, 09h     
int 21h   





;mov ah,1                        
;int 21h ; le saisie est dans al mais il faux ajouter 30 pour aller a le code ascci du nombrepour eviter ca utiliser la suivante


MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al


MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie
sub al,30h 

calculfacto: 

mov cl,al
sub cl,1  


loopfacto:

cmp cl,0
je finnn

mul cl;; le resultat du facto il sera dans al=n! 





loop loopfacto

finnn: 

ret



 
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;powww;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;  

pow:
 mov dx, offset opperr1
mov ah, 09h     
int 21h




MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
sub al,30h


mov oper1,al

mov dx, offset puissance
mov ah, 09h     
int 21h



MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
sub al,30h

mov oper2,al 



mov al,oper1


powloop: 

dec oper2


mul oper1    


cmp oper2,1 
jne powloop 

call affichage

jmp fin





;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;arrangement proc comb;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

arr proc  
    
  

mov dx, offset opperr1 ;;soit disant que ca n
mov ah, 09h     
int 21h




MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie
sub al,30h

mov oper1,al;;;n 
mov ah,0
push ax

mov dx, offset opperr2  ;;;soit disant que ca p
mov ah, 09h     
int 21h



MOV     AH, 00h   
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
sub al,30h 

mov oper2,al ;;;p



sub oper1,al;;oper1=n-p

mov al,oper1
 
mov dx,0fffh  

call facto ;;; va donner al=(n-p)!  

mov opf,al  ;;;opf=(n-p)! 


pop ax  ; ax=n=oper1

call facto ;;; va donner vous donner le resultat dans al=n!

div opf;;;al=n!/(n-p)!   affiche seulement la partie entiere


ret
 


;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;combinaisant;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

com:



call arr
mov ah,0

push ax ;;opf=n!/(n-p)! 

mov al,oper2

call facto ;;al=p!

mov p,al;p=p!

pop ax;;al=Anp

div p  ;;;al=Anp/p!

call affichage  

jmp fin

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;pgcd;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
 pgcd:
mov dx, offset opperr1
mov ah, 09h     
int 21h




MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
sub al,30h     


mov oper1,al;;;oper1=n 
mov opf,al

mov dx, offset opperr2
mov ah, 09h     
int 21h



MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie
sub al,30h

mov oper2,al      ;;oper2=m


mov ah,0
mov dl,al
pg: 


cmp oper2,0
je result 
mov bh,oper1
mov oper1,dl        ;oper1=n=m=al 
mov al,bh         ;;;al=n 
mov bl,oper2
div bl        ;al=n/m=oper1/oper2 
mov oper2,ah  ;; n=lancien mod(n/m=op1/op2)
mov dl,oper2       ;m=mod(oper2=al)=dl=oper2 
mov bh,oper1

jmp pg


result:

mov al,bh

call affichage

jmp fin
                   





;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;Somme;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; 


som: 

mov dx, offset opperr1
mov ah, 09h     
int 21h

 MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
sub al,30h  
mov oper1,al

 
 MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
cmp al,0Dh 


je op2

sub al,30h 


mov oper11,al       
 


mov al,oper1

mov bl,10
mul bl 

add al,oper11

mov opf1,al
jmp opp2


op2:
mov dh,oper1 
mov opf1,dh

opp2:
mov dx, offset opperr2
mov ah, 09h     
int 21h 

MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie
sub al,30h  
mov oper2,al

 
 MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 

cmp al,0Dh 

je addd
sub al,30h
mov oper22,al
 


mov al,oper2 
mov bl,10

mul bl

add al,oper22

mov opf2,al
jmp addd1

addd:
mov al,oper2

addd1:
 
 add opf1,al
 
 mov al,opf1
 
 call affichage
 
 jmp fin


 
          
          

ret

 ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;soustraction;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
sous: 
mov dx, offset opperr1
mov ah, 09h     
int 21h




MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie
sub al,30h

mov oper1,al

mov dx, offset opperr2
mov ah, 09h     
int 21h



MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
sub al,30h 

sub oper1,al
mov bl,al
mov al,oper1
cmp oper1,bl
jnl notneg 
neg al

mov ah,0
push ax
mov dx, offset res
mov ah, 09h     
int 21h

mov dx,'-' 
mov ah,02h
int 21h
pop ax
add al,30h
mov dl, al ; Mettez la valeur à afficher dans DL
  mov ah, 02h ; Fonction 02h de l'interruption 21h (afficher un caractère)
    int 21h

jmp fin  
notneg: 


mov ah,0
push ax
mov dx, offset res
mov ah, 09h     
int 21h 
pop ax
add al,30h

mov dl, al ; Mettez la valeur à afficher dans DL
  mov ah, 02h ; Fonction 02h de l'interruption 21h (afficher un caractère)
    int 21h

jmp fin  

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;division;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

divv:  

mov dx, offset opperr1 
mov ah, 09h     
int 21h




MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie
sub al,30h 



mov oper1,al

mov dx, offset opperr2
mov ah, 09h     
int 21h



MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
sub al,30h

cmp al,0

jne divcont
call error
jmp fin 

divcont: 

mov oper2,al

mov al,oper1 
mov ah,0

div oper2   ;;;dont worry about the rest cause i this is just for les valeurs entiers

call affichage

jmp fin


;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;mul;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; 
                                         
mull:

mov dx, offset opperr1
mov ah, 09h     
int 21h




MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie 
sub al,30h

mov oper1,al

mov dx, offset opperr2
mov ah, 09h     
int 21h



MOV     AH, 00h
INT     16h    ;; le saisie direct du nombre dans al

MOV     AH, 0Eh
INT     10h     ;;; affichage du saisie  
sub al,30h

mul oper1


call affichage 

jmp fin                                        





;putc 0Dh
;putc 0Ah 
;                         
;div 10;diviser al:dl/10  
;
;add al,10
;
;
;
;putc al;; mais al doit debuter de 30 a 38  
;
;mov al,dl
;
;;;;a l'interieur d'une boucle
;

affichage   proc 
    
      
push ax 

mov dx, offset res
mov ah, 09h     
int 21h

pop ax
;;;conversion avant l'affichage 
mov ah,0h

mov bl,10
div bl ; ax=quotion ax/10 et dx=reste cad premier degit a droit dans dx et dexieme degit dans ax
mov p,al

cmp al,10
jnge affiche


mov opf,ah
mov ah,0h
div bl 
mov aide,al


 
  
affiche:  

  
  
   
  add al,30h
  
  add ah,30h
  add opf,30h
  
  
   
    
    push ax
    
    mov dl, al ; Mettez la valeur à afficher dans DL
    mov ah, 02h ; Fonction 02h de l'interruption 21h (afficher un caractère)
    int 21h
    
     pop ax 
     
     mov al,ah
      
    
    mov dl,al
    
    mov ah,02h
 
    int 21h
    
    cmp p,10
    jnge  fini
    
    mov dl,opf
    mov ah,02h
    int 21h
   

fini: 




ret     









 fin:  
 mov dx, offset continue_msg
mov ah, 09h     
int 21h



mov ah,1   
int 21h ; le saisie est dans al de l'operation  

 cmp al,'o' 
 je etq 
  cmp al,'q'
  je  finfinal     
  
   cmp al,'o'
   jnl q 
 jmp fin
  
 q:
  cmp al,'q'
  
 jne fin 
  ppp:
  cmp al,'p'
  jne fin
  
   

finfinal:

ret  ;finir la prog




error proc
    
    
    mov ah, 09       
    lea dx,  errorm 
    int 21h         

 
    
    ret  
    
    
    
;;;;;;;;;;;;;;Plan suivante est passer a la saisie de deux nombres;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;    
;;;;;;;;;;;j'ai ajoute - lorsque le resultat de sub est negative ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;;;;;;;;;;;tout le programme marche facto jusqu'a 5 puissance jusqu'a 5 puissance 3??;;;;combinaisant n=5;;
;;;;;;;;pgcd les resultat des division doivent etre des entiers meme pour div;;;;;;;;;;;;;;;;; 
