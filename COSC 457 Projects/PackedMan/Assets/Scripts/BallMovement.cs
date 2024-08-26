using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class BallMovement : MonoBehaviour
{

    public float speed = 10.0f;
    private Rigidbody rb;

    public bool canJump = false;
    public float jumpHeight = 1000.0f;

    // Start is called before the first frame update
    void Start()
    {
        rb = GetComponent<Rigidbody>();
    }

    // Update is called once per frame
    void FixedUpdate()
    {
        float moveHorizontal = Input.GetAxis("Horizontal");
        float moveVertical = Input.GetAxis("Vertical");

        Vector3 movement = new Vector3(moveHorizontal, 0.0f, moveVertical);

        rb.AddForce(movement * speed);

    }

    void Update()
    {
        if (canJump && Input.GetButtonDown("Jump"))
        {
            Debug.Log("jumped");
            Vector3 jump = new Vector3(0.0f, 1.0f, 0.0f);
            rb.AddForce(jump * jumpHeight);
            canJump = false;
        }
    }

    void OnTriggerEnter(Collider other) {
        if (other.CompareTag("Powerup"))
        canJump = true;
    }

}
