using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class CounterEdit : MonoBehaviour
{

    public int CollectibleTotal = 0;
    int count;

    void OnEnable() => Collectible.OnCollected += OnCollectibleCollected;
    void onDisable() => Collectible.OnCollected -= OnCollectibleCollected;


    // Update is called once per frame
    void Update()
    {
        Debug.Log(count);

        if (count == CollectibleTotal)
        {
            Debug.Log("Level end");
            SceneManager.LoadScene("Menu");

        }
    }

    void OnCollectibleCollected()
    {
        count++;
    }
}
