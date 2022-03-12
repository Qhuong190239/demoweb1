<?php

namespace App\Controller;

use App\Entity\Book;
use PhpParser\Builder\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('book/api', methods:'GET', name:'book_api')]
    public function bookAPI() {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->json(
            ['books'=>$books],
            200 //HTTP: OK
        );
    }

    #[Route('/books', name:'book_index')]
    public function bookIndex() {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->render("book/index.html.twig",
        [
            'books' => $books
        ]);
    }

    #[Route('book/{id}', name:'book_detail')]
    public function bookDetail($id) {
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        if ($book == null) {
            $this->addFlash("Error", "Book not found");
            return $this->redirectToRoute("book_index");
        }
        return $this->render("book/detail.html.twig",
        [
            "book" => $book
        ]);
    }

    #[Route('book/delete/{id}', name:'book_delete')]
    public function bookDelete($id) {
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        if ($book == null) {
            $this->addFlash("Error", "Delete failed");
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($book);
            $manager>flush();
            $this->addFlash("Success", "Delete success");
        }
        return $this->redirectToRoute("book_index");        
    }

    #[Route('book/add', name:'book_add')]
    public function bookAdd(Request $request) {

    }

    #[Route('book/edit/{id}', name:'book_edit')]
    public function bookEdit(Request $request, $id) {

    }
}
